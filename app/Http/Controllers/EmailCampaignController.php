<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmailCampaign;
use \Session,\Redirect,\Validator,\Image;
use App\Private_company,App\Private_planroom_assigns,App\Private_project,App\Private_company_assign,App\Private_plans,App\Price,App\Private_order, App\Private_order_master;

class EmailCampaignController extends Controller
{
		public function campaignlist(Request $request,$company_slug){ 
                                
				$data = [];
        //$company = $this->companyExistCheck($company_slug);
				$comapny_id = Session::get('PRIVATE_COMPANY_DETAILS')->id;
				
				$data['list'] = EmailCampaign:: leftJoin('private_companies AS PC','PC.id', '=', 'email_campaigns.company_id')
																				->select('email_campaigns.id','email_campaigns.company_id','email_campaigns.user_id','email_campaigns.email_subject','email_campaigns.email_content','email_campaigns.status','email_campaigns.created_at','PC.id as company_id','PC.user_type','PC.company_name','PC.company_slug','PC.first_name','PC.last_name')
																				->addSelect(\DB::Raw("(SELECT GROUP_CONCAT(email) FROM ae_private_companies AS PC WHERE FIND_IN_SET(PC.id,ae_email_campaigns.user_id)) AS UserEmail"))
																				->where('email_campaigns.company_id',$comapny_id)
																				->paginate(10);
				
				
				//(SELECT GROUP_CONCAT(email)FROM ae_private_companies AS PC WHERE FIND_IN_SET(PC.id,ae_email_campaigns.user_id) AS UserEmail)			
				
				//select `ae_email_campaigns`.`company_id`, `ae_email_campaigns`.`user_id`, `ae_PC`.`id` as `company_id`, `ae_PC`.`user_type`, `ae_PC`.`company_name`, `ae_PC`.`company_slug`, `ae_PC`.`first_name`, `ae_PC`.`last_name`, (SELECT GROUP_CONCAT(email)FROM ae_private_companies AS PC WHERE FIND_IN_SET(PC.id,ae_email_campaigns.user_id)) AS UserEmail from `ae_email_campaigns` left join `ae_private_companies` as `ae_PC` on `ae_PC`.`id` = `ae_email_campaigns`.`company_id` where `ae_email_campaigns`.`company_id` = 9 limit 10 offset 0
								
				//echo "<pre>"; print_r($data['list']); echo "</pre>"; die();
				
        if(count($data['list']) > 0){
            return view('front.private.email_campaign_list',$data);
        }
				else{
                                    
            return view('front.private.email_campaign_no_record',$data);
        }
		}
		
		public function createcampaign(){
				$data = array();
				$company_id = Session::get('PRIVATE_COMPANY_DETAILS')->id;
				
				//select * from ae_private_company_assigns inner join ae_private_companies on ae_private_companies.id = ae_private_company_assigns.company_id where company_id = 9
				
				$data['userlist'] = Private_company_assign::join('private_companies','private_companies.id','=','private_company_assigns.company_id')
																				->where('company_id',$company_id)
																				->get();
																				
				return view('front.private.add_email_campaign',$data);
		}
		
		public function postcampaign(Request $request,$company_slug){
				$hidval = $request->action;
				$comapny_id = Session::get('PRIVATE_COMPANY_DETAILS')->id;
				$company = $this->companyExistCheck($company_slug);
				if($hidval){
						$validator = Validator::make(
                            $request->all(),
                            ['chkuser'             => 'required',
                             'email_subject'       => 'required',
                             'email_content'       => 'required',
                            ]);
						
						if ($validator->fails()){
								$messages = $validator->messages();
								return Redirect::back()->withErrors($validator)->withInput();
						}
						else{
								$saveCampaign                       = new EmailCampaign();
								$saveCampaign->company_id						= $comapny_id;
								$saveCampaign->user_id            	= implode(",",$request->chkuser);
								$saveCampaign->email_subject        = $request->email_subject;
								$saveCampaign->email_content        = $request->email_content;
								$saveCampaign->status           		= "Inactive";
								$saveCampaign->save();
								
								return Redirect::route('email_campaign_list_for_company',Session::get('COMPANY_SLUG'));
								//return route('email_campaign_list_for_company',Session::get('COMPANY_SLUG'))->with('succmsg','Campaign Added Successfully!');
						}
				}			
		}

		
		/*
     * campaign edit
     */
    public function edit($slug,$id){
				
        $data['userlist'] = Private_company::where('user_type','user')->get();
				
				$data['list'] = EmailCampaign::leftJoin('private_companies AS PC','PC.id', '=', 'email_campaigns.company_id')
																				->select('email_campaigns.*','PC.id as company_id','PC.company_name as CompanyName')
																				->where('email_campaigns.id',$id)
																				->get();
		
        return view('front.private.edit_email_campaign',$data);
    }
		
		
		/*
     * campaign update
     */
		public function update(Request $request){
				$hidval = $request->id;
				
				$validator = Validator::make(
                            $request->all(),
																['chkuser'             => 'required',
																 'email_subject'       => 'required',
																 'email_content'       => 'required',
																]);
						
				if ($validator->fails()){
						$messages = $validator->messages();
						return Redirect::back()->withErrors($validator)->withInput();
				}
				else{
						$updateCampaign  											= EmailCampaign::find($request->id);
						$updateCampaign->company_id						= $request->company_id;  
						$updateCampaign->user_id            	= implode(",",$request->chkuser);
						$updateCampaign->email_subject        = $request->email_subject;
						$updateCampaign->email_content        = addslashes($request->email_content);
						$updateCampaign->save();
						
						return Redirect::route('email_campaign_list_for_company',Session::get('COMPANY_SLUG'))->with('success','Campaign updated successfully');
				}
    }
		
		/*
		 *campaign sendmail
		 */
		
		public function sendmail($slug,$id){
				
				$list = EmailCampaign::leftJoin('private_companies AS PC','PC.id', '=', 'email_campaigns.company_id')
																				->select('email_campaigns.*','PC.id as company_id','PC.company_name as CompanyName','PC.first_name as FirstName')
																				  ->addSelect(\DB::Raw("(SELECT GROUP_CONCAT(email) FROM ae_private_companies AS PC WHERE FIND_IN_SET(PC.id,ae_email_campaigns.user_id))AS UserEmail"))
																				->where('email_campaigns.id',$id)
																				->get();
				
				$data = array();
				$data['content'] = $list[0]->email_content;
				$data['name'] = $list[0]->FirstName;
				
				$mail_config = array(
														'subject'			=> $list[0]->email_subject,
														'from_mail'  	=> 'admin@aerepro.com',
														'from_name'  	=> $list[0]->CompanyName,
														//'to_mail'     => 'subhasish.ghosh@webskitters.com'
														'to_mail'     => $list[0]->UserEmail
												);
				
				\Mail::send('emails.campaign_mail', $data, function($message) use ($mail_config){
						$message->subject($mail_config['subject']);
						$message->from($mail_config['from_mail']);
						$message->to($mail_config['to_mail']);
				});
				
				$mailsend = EmailCampaign::find($id);
				$mailsend->mail_send	= 'Yes';
				$mailsend->save();
				
				return Redirect::route('email_campaign_list_for_company',Session::get('COMPANY_SLUG'))->with('success','Mail Send successfully');
		}
		
}