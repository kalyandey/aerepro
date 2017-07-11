@extends('front.app')
@section('content')
<style>
.subProgressBar{height: 24px;text-align: center;transform: translate(0, 0%);z-index: 10;border: 0;border-radius: 0;background: none;}
.subProgressBar .ui-progressbar-value{background: #86bd0f;color: #fff;line-height: 24px;height: 100%;border: 0;border-radius: 0;}
.subProgressBar .progress-label {color: #000;font-size: 14px;left: 0;line-height: 24px;position: absolute;right: 0;}
.progessBar {background-color: gray;}
    </style>
    <div class="container">
        <div class="deshboard breport clear">
	<h3><strong>Order</strong> Reports</h3>
	<strong class="welcome">Welcome <span>{{Session::get('USER_DETAILS')->first_name.' '.Session::get('USER_DETAILS')->last_name}}</span></strong>	
	<a href="{{URL::route('dashboard')}}" class="btn-db">Dashboard</a>
	    
        @if(count(\Cart::content()) > 0)
	<a href="{{URL::route('my_cart')}}" class="cart cart-button"> {{ count(\Cart::content())}} Cart item</a>
	@endif
	<div class="report-table">
            {!! Form::open(array('route'=>array('customer_zip_file'),'class'=>'form-horizontal','files'=>true,'method'=>'post','id'=>'planFrm')) !!}
            <div class="imgBox1">
            <input type="file" id='uploadPhoto' class='fileUpload multiupload' multiple accept='application/pdf'/>
            </div>
            <div class="photosDivSec">
                <div class="loadMorePicContainer"></div>
            </div>
	    {{Form::submit('Submit',['class'=>'btn-srrp'])}}
            {!! Form::close() !!}
        </div>
	</div>
    </div>
     <script>
            $(function(){
               $('.fileUpload').change(function(){
                        uploadWithPreview(this);
               });
               
               $.ajax({
                url: BASE_URL + '/user/file-lists',
                type:'post',
                data:{
                  "_token": CSRF_TOKEN
                },
                dataType:'JSON',
                success:function(response){
                    if (response.file.length  > 0) {
                        $.each(response, function(index, element){
                            var loadMoreContent = $('.photosDivSec').find(".loadMorePicContainer")
                            if ($(loadMoreContent).find('tbody').length == 0) {
                            $(loadMoreContent).append(
                               '<br><table id="no-more-tables" class="res-table2"><thead><tr><th>File Name</th><th>Action</th></tr></thead><tbody></tbody></table>'
                               );
                            }
                            $.each(element , function(i,p){
                               $(loadMoreContent).find('tbody').append(
                               '<tr class="appendPdf"><td>'+p.file_name+'</td><td><a href="javascript:void(0);" onclick="removePdf(this)" data-item="'+p.id+'" class="btn btn-info">Delete</a></td></tr>'
                               );
                            })
                                    
                        });
                    }
                }
             });
             
            });
            function removePdf(element) {
                if (confirm('Are you sure??')) {
                            $(element).parents('.appendPdf').remove();
                            $.ajax({
                              url: BASE_URL + '/user/file-delete',
                               type:'post',
                               data:{
                                 "_token": CSRF_TOKEN,
                                 'plan_id' : $(element).attr('data-item')
                               },
                            })
                }
            }   
                    
            function uploadWithPreview(element) {
                var fileList = element.files;
                var target = $(element);
                for(var i = 0; i < fileList.length; i++){
                var loadMoreContent = $(element).parents('.imgBox1').parent().find(".loadMorePicContainer");
                
                var dataItem = 0;
                if ($(loadMoreContent).find('.photosDiv').last().attr('data-item') != undefined ) {
                     dataItem = Number($(loadMoreContent).find('.photosDiv').last().attr('data-item'))+1;
                }
                if ($(loadMoreContent).find('tbody').length == 0) {
                            $(loadMoreContent).append(
                                        '<br><table cid="no-more-tables" class="res-table2"><thead><tr><th>Plan Name</th><th>Action</th></tr></thead><tbody></tbody></table>'
                                        );
                }
                $(loadMoreContent).find('tbody').append(
                                        '<tr class="appendPdf preview"><td class="plan_name"></td><td class="removeAppend"><div class="progessBar" id="progress_'+i+'"><div class="subProgressBar"><div class="progress-label">Starting...</div></div></div></td></tr>'
                                        );
                 $('.loadMorePicContainer').show();
                 
        
                 // get rid of the blob
                 window.URL.revokeObjectURL(fileList[i]);
                }
              
                $('.loadMorePicContainer').show();
                 var i = 0;
                 var reader = new FileReader();
                 
                 reader.onloadend = (function(file) {
                     return function(evt) {
                       uploadImage(target, evt.target.result, fileList, i ,file.name, $(loadMoreContent).find('.preview').first())
                     };
                   })(fileList[i]);
                 reader.readAsDataURL(fileList[i]);
            }
            function uploadImage(target, file,fileList, index,filename,previewBox) {
                       
                    var formData = new FormData();
                    formData.append('image', file);
                    formData.append('file_name',filename);
                    formData.append('_token',CSRF_TOKEN);
                    //formData.append('user_id',$("input[name=user_id]").val());
                    
                    var ajax = new XMLHttpRequest();
                    //ajax.setRequestHeader("Content-Type", "application/pdf");
                    ajax.open("POST", BASE_URL+'/user/customer-upload-pdf' ,true);
                    //ajax.setRequestHeader("User-Agent", "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1");
                     var ind = Number($(target).attr('data-file-index'));
                     var progressbar = $(previewBox).find('.subProgressBar'),
                    progressLabel = $(previewBox).find('.subProgressBar').find('.progress-label');
                    progressbar.progressbar({
                        value: false,
                        change: function(event, ui) {
                                progressLabel.text( progressbar.progressbar( "value" ) + "%" );
                        },
                        complete: function(event, ui) {
                          progressLabel.text( "Processing..." );
                        }
                      });
                     ajax.upload.addEventListener("loadstart", function (evt) {
                      
                     }, true);
                
                    ajax.upload.addEventListener("progress", function (evt) {
                        
                        var percentLoaded = parseInt( (evt.loaded / evt.total) * 100) ;
                        progressbar.progressbar( "value", percentLoaded );
                        
                    }, true);
                
                    ajax.upload.addEventListener("load", function (evt) {
                       $(previewBox).find('.photoBox').css('opacity',1);
                       
                       
                       ind = ind+1;
                       $(target).attr('data-file-index',ind);
                       
                       $(progressbar).parent().remove();
                    }, true);
                    ajax.onreadystatechange = function() {
                        if (ajax.readyState == 4 && ajax.status == 200){
                        var response = $.parseJSON(ajax.responseText);
                        
                        $(previewBox).find('.removeAppend').html('<a href="javascript:void(0);" data-item="'+response.id+'" class="btn btn-info" onclick="removePdf(this)">Delete</a>');
                        $(previewBox).find('.removePhoto').attr('data-item',response.id);
                        $(previewBox).find('.removeBox').attr('data-project',response.user_id)
                        $(previewBox).find('.plan_name').html(response.file_name)
                        $(previewBox).find('input[type=checkbox]').removeAttr('readonly');
                        $(previewBox).find('input[type=checkbox]').addClass('addcheck');
                        $(previewBox).find('input[type=checkbox]').val(response.id);
                        
                           setTimeout(function(){
                                    var i = index+1;
                                    if (i < fileList.length) {
                                            var reader = new FileReader();
                                            reader.onloadend = (function(file) {
                                               return function(evt) {
                                                 uploadImage(target, evt.target.result,fileList, i,file.name, $(previewBox).next())
                                               };
                                            })(fileList[i]);                    
                                            reader.readAsDataURL(fileList[i]);
                                     }else if (i == fileList.length) {
                                            $(target).val(null);
                                     }
                                     $(previewBox).removeClass('preview');
                            },600);
                          // $(uploaderObj.loadbtn).hide();
                        }
                    };
                    
                    ajax.send(formData);     
                        
            }

     </script>
@endsection