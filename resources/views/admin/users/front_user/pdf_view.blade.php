@extends('admin.layout')
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/multiple-pdf-upload.css')}}">

    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Customer</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Customer</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Customer : {!! $userdtls->first_name !!}</div>
                        </div>
                        <!--<div class="portlet-body">
                            </div>-->
                            <div class="row">
                                <div class="col-md-12">
                                <input type="hidden" name="project_id" value="{{$userdtls->id}}" />
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_customer_zip_file'),'class'=>'form-horizontal','files'=>true,'method'=>'post','id'=>'planFrm')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        {!! Form::hidden('user_id',$userdtls->id)!!}
                                                <div  class="row appendData" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">
                                                        <div class="portlet box blue-hoki"> 
                                                            <div class="portlet-body">
                                                                <div class="imgBox1">
                                                                <div class="dragBoxs">
                                                                    <div class="heading"><i class="fa fa-cloud-upload" style="color:#14b9d6;font-size:50px;"></i> <font size="6">Drop Images</font>&nbsp;<span style="font-style:italic;font-size:15px"> to upload (or click)</span></div>
                                                                    <input type="file" data-file-index='0' id='uploadPhoto' class='dragInput fileUpload multiupload' multiple accept='application/pdf'/>
                                                                </div>
                                                                <div class="photosDivSec">
                                                                    <div class="loadMorePicContainer"></div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                </div>
                                        </div>   
                                        <div class="form-actions pal">
                                                <div class="form-group mbn">
                                                    <div class="col-md-offset-5 col-md-6">
                                                    {{Form::submit('Zip create',['class'=>'btn btn-green'])}}
                                                    <a class="btn btn-primary" onclick="deletePlans()" >&nbsp;Delete &nbsp;</a>&nbsp;&nbsp;&nbsp;
                                                    <a class="btn btn-green" href="#">Cancel</a>
                                                    </div>
                                                </div>
                                         </div>
                                        {!! Form::close() !!} 
                                </div>
                            </div>
                            <div style="clear:both"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>    
            <script>
            $(function(){
               $('.fileUpload').change(function(){
                        uploadWithPreview(this);
               });         
            });
            function deletePlans() {
                        var plan = ""; ; 
                        $('.addcheck:checked').each(function(){
                          plan +=$(this).val()+",";
                          $(this).parents('tr').hide();
                        });
                        if (plan != '') {
                        setTimeout(function(){
                                    $.ajax({
                                       url : ADMIN_URL+'/delete-multiple-files',
                                       type:'POST',
                                       data: {plans:plan,_token : CSRF_TOKEN},
                                    });
                        },500);
                        }else{
                                    alert('Please check any plan to delete');
                        }
            }
            var fileList = [];
                        function uploadWithPreview(element) {
                                    var fileList = element.files;
                                    var target = $(element);
                                    for(var i = 0; i < fileList.length; i++){
                                    var loadMoreContent = $(element).parents('.imgBox1').find(".loadMorePicContainer");
                                    
                                    var dataItem = 0;
                                    if ($(loadMoreContent).find('.photosDiv').last().attr('data-item') != undefined ) {
                                         dataItem = Number($(loadMoreContent).find('.photosDiv').last().attr('data-item'))+1;
                                    }
                                    if ($(loadMoreContent).find('tbody').length == 0) {
                                                $(loadMoreContent).append(
                                                            '<br><table class="table table-bordered table-advanced"><thead><tr><th><input type="checkbox" class="checkall" onclick="checkRemoveAll(this)"></th><th>Plan Name</th><th>Action</th></tr></thead><tbody></tbody></table>'
                                                            );
                                    }
                                    $(loadMoreContent).find('tbody').append(
                                                            '<tr class="appendPdf preview"><td><input type="checkbox" name="filezip_check[]" readonly value=""></td><td class="plan_name"></td><td class="removeAppend"><div class="progessBar" id="progress_'+i+'"><div class="subProgressBar"><div class="progress-label">Starting...</div></div></div></td></tr>'
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
                        function removeBox(element) {
                                   if (confirm('Are you sure??')) {
                                    
                                                $.ajax({
                                                  url : ADMIN_URL + '/project-plans-remove',
                                                  type : 'POST',
                                                  beforeSend:function(){
                                                                $(element).find('.fa').removeClass('hide');
                                                  },
                                                  data:{
                                                            _token : CSRF_TOKEN,
                                                            project_id : $(element).attr('data-project'),
                                                  },
                                                  dataType : 'JSON',
                                                  success:function(response){
                                                           if (response.code == 1) {
                                                             $(element).parents('.appendsubbody').remove();
                                                           }
                                                  }
                                                });
                                      
                                    }
                        }
                        function checkRemoveAll(element) {
                            $(element).parents('table').find('input[type=checkbox].addcheck').prop('checked',$(element).prop('checked'))
                        }
                        
                       function uploadImage(target, file,fileList, index,filename,previewBox) {
                       
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('file_name',filename);
                        formData.append('_token',CSRF_TOKEN);
                        formData.append('user_id',$("input[name=user_id]").val());
                        
                        var ajax = new XMLHttpRequest();
                        //ajax.setRequestHeader("Content-Type", "application/pdf");
                        ajax.open("POST", ADMIN_URL+'/customer-upload-pdf' ,true);
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
                    
                    function removePdf(element) {
                        if (confirm('Are you sure??')) {
                                    $(element).parents('.appendPdf').remove();
                                    $.ajax({
                                      url: ADMIN_URL + '/file-delete',
                                       type:'post',
                                       data:{
                                         "_token": CSRF_TOKEN,
                                         'plan_id' : $(element).attr('data-item')
                                       },
                                    })
                        }
                    }
                    
                        $(function(){
                        
                        $.ajax({
                           url: ADMIN_URL + '/file-lists',
                           type:'post',
                           data:{
                             "_token": CSRF_TOKEN,
                             'user_id' : $("input[name=user_id]").val()
                           },
                           dataType:'JSON',
                           success:function(response){
                                    if (response.file.length  > 0) {
                                             $.each(response, function(index, element){
                                                         var loadMoreContent = $('.appendData').last().find(".loadMorePicContainer")
                                                         if ($(loadMoreContent).find('tbody').length == 0) {
                                                         $(loadMoreContent).append(
                                                            '<br><table class="table table-bordered table-advanced"><thead><tr><th><input type="checkbox" class="checkall" onclick="checkRemoveAll(this)"></th><th>File Name</th><th>Action</th></tr></thead><tbody></tbody></table>'
                                                            );
                                                         }
                                                         $.each(element , function(i,p){
                                                            $(loadMoreContent).find('tbody').append(
                                                            '<tr class="appendPdf "><td><input type="checkbox" name="filezip_check[]" class="addcheck" value="'+p.id+'"></td><td>'+p.file_name+'</td><td><a href="javascript:void(0);" onclick="removePdf(this)" data-item="'+p.id+'" class="btn btn-info">Delete</a></td></tr>'
                                                            );
                                                         })
                                                         
                                             })
                                    }
                           }
                        });
                                   
                        });


            </script>
@endsection