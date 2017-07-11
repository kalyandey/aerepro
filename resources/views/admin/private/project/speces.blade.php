@extends('admin.layout')
@section('content')
<link type="text/css" rel="stylesheet" href="{{ asset('admin_assets/css/multiple-pdf-upload.css')}}">

    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Edit Project</div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="javascript:void(0);">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                    <li class="active">Edit Project</li>
                </ol>
                <div class="clearfix"></div>
    </div>
    <div class="page-content">
        <div id="form-layouts" class="row">
            <div class="col-lg-12">
                    <div class="portlet box portlet-yellow">
                        <div class="portlet-header">
                            <div class="caption">Edit Project : {!! $details->company->company_name !!}</div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="topTabText">
                                    @include('admin.private.project.menu')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                <input type="hidden" name="project_id" value="{{$details->id}}" />
                                    <!--<h3>Account Information</h3>-->
                                    <br>
                                        {!! Form::open(array('route'=>array('admin_private_project_speces',$details->id),'class'=>'form-horizontal','files'=>true,'method'=>'post','id'=>'planFrm')) !!}
                                        {!! Form::hidden('action','Process')!!}
                                        <div class="appendPlans"></div>      
                                        <div class="form-actions">
                                        <div class="col-md-12">
                                        <div class="btn btn-info add_more_plans">Add more</div>
                                        <a href="{{URL::route('admin_private_project')}}" class="btn btn-primary" type="button">Submit</a>
                                        <a href="{{URL::route('admin_private_project')}}" class="btn btn-warning" type="button">Skip</a>
                                        <a href="{{URL::route('admin_private_project_plans',[$details->id])}}" class="btn btn-default" type="button">Back</a>
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
            <div class="planBody" style="display:none;">
            <div  class="row appendData" style="border-bottom:1px dotted #CCC;padding : 10px 2px;">
            <div class="form-group">
                <label for="spece_category" class="col-md-2 control-label">Select Plan Category</label>
                <div class="col-md-9">{!! Form::select('spece_category[]',$spece_category,'',['class'=>'form-control append_spece_category required'])!!}</div>
            </div>
                    <div class="portlet box blue-hoki">
                        
                        <div class="portlet-body">
                            <div class="imgBox">
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
            <div class="planfileAdd"></div>
            <div class="form-group text-right">
                        <div class="col-md-2"><a onclick="removeBox(this)" class="btn btn-danger removeBox">Remove Category <i class="fa fa-refresh fa-spin hide"></i></a></div>
            </div>
            </div>
            </div>
            <script>
            var fileList = [];
                        function viewImgbox(element) {
                           if ($(element).val() !='') {
                                    $(element).parents('.appendData').find(".imgBox").show();
                          }else{
                                    $(element).parents('.appendData').find(".imgBox").hide();
                          }
                        }
                        function uploadWithPreview(element) {
                                    var fileList = element.files;
                                    var target = $(element);
                                    for(var i = 0; i < fileList.length; i++){
                                     var objectUrl = BASE_URL+'/images/pdf-icon.png';
                                     var loadMoreContent = $(element).parents('.appendsubbody').find(".loadMorePicContainer");
                                     var dataItem = 0;
                                     if ($(loadMoreContent).find('.photosDiv').last().attr('data-item') != undefined ) {
                                          dataItem = Number($(loadMoreContent).find('.photosDiv').last().attr('data-item'))+1;
                                     }
                                     var h = $("<div/>").appendTo(loadMoreContent).addClass('photosDiv preview')
                                                         .attr('data-item', dataItem);
                                     var h_s = $("<span/>").appendTo(h)
                                                            .addClass('removePhoto')
                                                             .bind('click',function(){ removePdf(this) })
                                                            .append('<i class="fa fa-remove"></i>');
                                     var h_a = $("<a/>").appendTo(h).addClass('photoBox').attr('href','javascript:');
                                     var h_i = $('<img/>').appendTo(h_a).attr('src',objectUrl);
                                     var h_title = $("<p/>").appendTo(h).addClass('plan_name');
                                     var h_p = $('<div/>').appendTo(h).addClass('progessBar').attr('id','progress_'+i);
                                     var h_s_p = $("<div/>").appendTo(h_p).addClass('subProgressBar');
                                     $("<div/>").appendTo(h_s_p).addClass('progress-label').text('Loading...');
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
                                    
                                                if ($(element).has('[data-cate]')) {
                                                $.ajax({
                                                  url : ADMIN_URL + '/private-project-specs-remove',
                                                  type : 'POST',
                                                  beforeSend:function(){
                                                                $(element).find('.fa').removeClass('hide');
                                                  },
                                                  data:{
                                                            _token : CSRF_TOKEN,
                                                            project_id : $(element).attr('data-project'),
                                                            cate_id : $(element).attr('data-cate'),
                                                  },
                                                  dataType : 'JSON',
                                                  success:function(response){
                                                           if (response.code == 1) {
                                                             $(element).parents('.appendsubbody').remove();
                                                           }
                                                  }
                                                })
                                                        
                                                }else{
                                                            $(element).parents('.appendsubbody').remove();
                                                }
                                      
                                    }
                        }
                        
                        function removeFile(element) {
                                    if (confirm('Are you sure??')) {
                                    $(element).parents('.form-group').remove();
                                    }
                        }
                       function uploadImage(target, file,fileList, index,filename,previewBox) {
                       
                        var formData = new FormData();
                        formData.append('image', file);
                        formData.append('file_name',filename);
                        formData.append('_token',CSRF_TOKEN);
                        formData.append('project_id',$("input[name=project_id]").val());
                        formData.append('category_id', $(target).parents('.appendsubbody').find(".append_spece_category").val());
                       
                        //formData.append('id', $("input[name=id]").val());
                        
                        var ajax = new XMLHttpRequest();
                        //ajax.setRequestHeader("Content-Type", "application/pdf");
                        ajax.open("POST", ADMIN_URL+'/private-specs-project-upload-pdf' ,true);
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
                              progressLabel.text( "Complete!" );
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
                            
                            $(previewBox).find('.removePhoto').attr('data-item',response.id);
                            $(previewBox).parents('.appendData').find('.removeBox').attr('data-project',response.project_id)
                            $(previewBox).parents('.appendData').find('.removeBox').attr('data-cate',response.cate_id)
                            $(previewBox).parents('.appendData').find('.plan_name').html(response.plan_name)
                            
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
                                    $(element).parents('.photosDiv').remove();
                                    $.ajax({
                                      url: ADMIN_URL + '/private-project-specs-delete',
                                       type:'post',
                                       data:{
                                         "_token": CSRF_TOKEN,
                                         'plan_id' : $(element).attr('data-item')
                                       },
                                       
                                    })
                        }
                    }
                    
                                            $(function(){
                        $('.add_more_plans').click(function(){
                                    $('.appendPlans').append("<div class='appendsubbody'>"+$('.planBody').html()+'</div>');
                                    $('.appendPlans').find('.appendData').last().find('.append_spece_category').attr('name','option['+($('.appendsubbody').length -1)+'][spece_category]');
                                    $('.appendPlans').find('.appendData').last().find('.append_plan_file').attr('name','option['+($('.appendsubbody').length -1)+'][file_name][]');
                                    $(".appendsubbody:eq(0) .removeBox").hide();
                                   $('.appendPlans').find('.appendData').last().find('.fileUpload').attr('onchange','uploadWithPreview(this)');
                                   $('.appendPlans').find('.appendData').last().find('.append_spece_category').attr('onchange','viewImgbox(this)');
                                   
                        });
                        
                        $.ajax({
                           url: ADMIN_URL + '/private-project-specs-lists',
                           type:'post',
                           data:{
                             "_token": CSRF_TOKEN,
                             'project_id' : $("input[name=project_id]").val()
                           },
                           dataType:'JSON',
                           success:function(response){
                                    if (response.length  > 0) {
                                             $.each(response, function(index, element){
                                             
                                                         $('.appendPlans').append("<div class='appendsubbody'>"+$('.planBody').html()+'</div>');
                                                         $('.appendPlans').find('.appendData').last().find('.append_spece_category').attr('name','option['+($('.appendsubbody').length -1)+'][spece_category]');
                                                         $('.appendPlans').find('.appendData').last().find('.append_spece_category').val(element.spec_cat_id)
                                                         $('.appendPlans').find('.appendData').last().find('.append_plan_file').attr('name','option['+($('.appendsubbody').length -1)+'][file_name][]');
                                                         $(".appendsubbody:eq(0) .removeBox").hide();
                                                         $('.appendPlans').find('.appendData').last().find('.fileUpload').attr('onchange','uploadWithPreview(this)');
                                                         $('.appendPlans').find('.appendData').last().find('.append_spece_category').attr('onchange','viewImgbox(this)');
                                                         $(".appendsubbody").last().find( ".removeBox").attr('data-cate',element.spec_cat_id);
                                                         $(".appendsubbody").last().find( ".removeBox").attr('data-project',element.project_id);
                                                         var objectUrl = BASE_URL+'/images/pdf-icon.png';
                                                         $.each(element.plans , function(i,p){
                                                            var loadMoreContent = $('.appendPlans').find('.appendData').last().find(".loadMorePicContainer")
                                                            var h = $("<div/>").appendTo(loadMoreContent).addClass('photosDiv')
                                                         .attr('data-item', i );
                                                            var h_s = $("<span/>").appendTo(h)
                                                                        .addClass('removePhoto')
                                                                        .bind('click',function(){ removePdf(this) })
                                                                        .attr('data-item',p.id)
                                                                        .append('<i class="fa fa-remove"></i>');
                                                            var h_a = $("<a/>").appendTo(h).addClass('photoBox').attr('href','javascript:').css('opacity',1);
                                                            var h_i = $('<img/>').appendTo(h_a).attr('src',objectUrl);
                                                            var h_title = $("<p/>").appendTo(h).html(p.name);
                                                            
                                                         })
                                                         
                                                         viewImgbox($('.appendPlans').find('.appendData').last().find('.append_spece_category'));
                                             })
                                    }else{
                                          $('.add_more_plans').trigger('click');      
                                                
                                    }
                                    
                           }
                        
                        });
                                   
                        });
            </script>
@endsection