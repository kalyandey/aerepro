<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\EmailCampaign;
use \Session,\Redirect,\Validator,\Image;
use App\Private_company,App\Private_planroom_assigns,App\Private_project,App\Private_company_assign,App\Private_plans,App\Price,App\Private_order, App\Private_order_master;

class EmailCampaignController extends Controller
{
		/*
     * campaign listing
     */
		public function index(Request $request){   
				$data = [];
				
				$data['keyword'] = '';
        if($request->keyword != ''){
            $data['keyword'] = $request->keyword;
        }
				
				$data['lists'] = EmailCampaign:: leftJoin('private_companies AS PC','PC.id', '=', 'email_campaigns.company_id')
																				->select('email_campaigns.id','email_campaigns.company_id','email_campaigns.user_id','email_campaigns.email_subject','email_campaigns.email_content','email_campaigns.status','email_campaigns.mail_send','email_campaigns.created_at','PC.id as company_id','PC.user_type','PC.company_name','PC.company_slug','PC.first_name','PC.last_name')
->addSelect(\DB::Raw("(SELECT GROUP_CONCAT(email) FROM ae_private_companies AS PC WHERE FIND_IN_SET(PC.id,ae_email_campaigns.user_id))AS UserEmail"))
																				->where(function($query) use ($data) {
																						if($data['keyword'] != ''){
																								//$query->havingRaw("UserEmail like %".$data['keyword']."%");
																								$query->orWhere('email_campaigns.email_subject','like','%'.$data['keyword'].'%');
																								
																				}})
																				//->havingRaw("UserEmail like '%".$data['keyword']."%'")
																				->orderBy('email_campaigns.company_id','ASC')
																				->paginate(10);
																				//->get();
				
				//echo "<pre>"; print_r($data['lists']); echo "</pre>"; die();
				return view('admin.campaign.list',$data);
		}
		
		/*
     * campaign edit
     */
    public function edit($id){
				
        $data['userlist'] = Private_company::where('user_type','user')->get();
				
				$data['list'] = EmailCampaign::leftJoin('private_companies AS PC','PC.id', '=', 'email_campaigns.company_id')
																				->select('email_campaigns.*','PC.id as company_id','PC.company_name as CompanyName')
																				->where('email_campaigns.id',$id)
																				->get();
				
				//dd($data['lists']);
        return view('admin.campaign.edit',$data);
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
						$updateCampaign->status           		= $request->status;;
						$updateCampaign->save();
						
						return Redirect::route('admin_emailcampaign')->with('success','Profession is updated successfully');
				}
				
    }
}
