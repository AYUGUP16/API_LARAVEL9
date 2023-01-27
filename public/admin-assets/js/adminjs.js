$(function () {
    $('.table').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});




///////Show toastr messages////////
$(".admin-toastr").trigger('click');
function toastr_success(msg) {
    toastr.success(msg)
}
function toastr_danger(msg) {
    toastr.error(msg)
}
///////Show toastr messages////////



/////////////////////////////////////////////////June-01-2022////////////////////////////////////////////////////

var originurl   = window.location.origin; 

/////////Category form validation////////

$(function () {   

    $('#add_new_parentcat_form').validate({
       
      rules: {
        parent_cat_name: {
          required: true,
          // minlength: 5         
        },
        parent_cat_icon:{
          //required: true   
            required: {
                depends: function(elem) {                    
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'parentcat_editform';
                } 
            }      
        },
        cat_status: {
          required :true
        }
        
      },
      messages: {
        parent_cat_name: {
          required: "Please enter Category"          
        },
        parent_cat_icon: {
          required: "Please choose a category image."          
        },
        cat_status: {
          required: "Please Select Status."          
        }
        
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      }
    });

    $("#add_new_childcat_form").validate({
       
        rules: {
            parent_id: {
                required: true                  
            },
            child_cat_name:{
                required: true 
            }, 
            child_cat_icon:{
                //required: true
                required: {
                    depends: function(elem) {                    
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'childcat_editform';
                    } 
                }     
            },
            child_status: {
                required: true
            }
          
        },
        messages: {
            parent_id: {
            required: "Please select parent Category"          
          },
          child_cat_name: {
            required: "Please enter child-category name."          
          },
          child_cat_icon: {
            required: "Please choose child category icon."          
          },
          child_status:{
            required: "Please choose at least one option." 
          }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });

    
    $("#add_new_subchild_form").validate({
       
        rules: {
            subchild_parent_id: {
                required: true                  
            },
            subchild_child_id:{
                required: true 
            }, 
            subchild_cat_name:{
                required: true
            },
            subchild_cat_icon:{
                //required: true
                required: {
                    //Apply Validation only in "Add New Subchild Form" not in "Edit Subchild Form"
                    depends: function(elem) {                    
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'subchildcat_editform';
                    } 
                }     
            },
            subchild_status: {
                required: true
            }
          
        },
        messages: {
            subchild_parent_id: {
            required: "Please select parent Category"          
          },
          subchild_child_id: {
            required: "Please select child Category."          
          },
          subchild_cat_name: {
            required: "Please enter child category name."          
          },
          subchild_cat_icon:{
            required: "Please choose child category icon."
          },
          subchild_status:{
            required: "Please choose at least one option." 
          }
          
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });

    
    $('#add_new_subadmin_form').validate({
        
        rules: {
          email: {
            required: true,
            email: true,
            //email_rule: true
            email_rule: {
                 //Apply validation only in "Add new Subadmin" not in "Edit Subadmin Form"   
                depends: function(elem) {   
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            }

          },
          password: {            
            minlength: 5,
            //required: true,
            required: {
                //Apply Validation only in "Add new Subadmin From" not in "Edit Subadmin Form"
                depends: function(elem) {   
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            } 

          },
          username: {
            required: true,
            minlength: 5,
            maxlength: 15,            
            //username_rule: true
            username_rule: {
                depends: function(elem) {        
                    //Apply validation only on Add new Subadmin            
                    var fomrs_id = $(this).parents("form").attr("id");                   
                    return fomrs_id != 'subadmin_editform';
                } 
            }

          },
          phoneNumber: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10
            },
            subadmin_status: {
              required :true
            },
        },
        

        messages: {
          email: {
            required: "Please enter a email address",
            email: "Please enter a valid email address"
          },
          password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 5 characters long"
          },
          username: {
            required: "Please enter a username",
            minlength: "Your username must be at least 5 characters long",
            maxlength: "Your username should not exceed 15 characters.",
          },
          phoneNumber: {
            required: "Please enter phone number",
          //    minlength: "Your phone number must be at least 10 digit long",
          //   maxlength: "Your username should not exceed 15 characters.",
          },
            subadmin_status: {
                required: "Please choose status",
            }
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
    });  

    $("#add_new_user_form").validate({

        rules: {
            firstname: {
                required: true,
                // minlength: 5         
            },
            lastname:{
                required: true, 
            },
            email:{
                required: true,
                email: true,  
                //email_custom_rule : true,   
                email_custom_rule: {
                     //Apply validation only in "Add New Users" not in "Edit User Form"   
                    depends: function(elem) {   
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'users_editform';
                    } 
                }           
            },
            country :{
                required: true,
            },          
            user_status :{
                required: true,
            },
            password :{
                //required: true,
                 required: {
                    //Apply Validation only in "Add new Subadmin From" not in "Edit Subadmin Form"
                    depends: function(elem) {   
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'users_editform';
                    } 
                }
            }

        },
        messages: {
            firstname: {
              required: "Please enter first name",
            },
            lastname: {
              required: "Please enter last name",
            },
            email:{
                required: "Please enter Email",
            },
            country:{
                required: "Please select country",
            },          
            user_status :{
                required: "Please select at least one",
            },
            password : {
                required: "Please enter user password",
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

    });

    $("#add_new_blog_form").validate({

        rules: {
            title: {
                required: true,                        
            },
            content:{
                required: true, 
            },
            blog_icon:{   
                required: {
                    depends: function(elem) {                    
                        var fomrs_id = $(this).parents("form").attr("id");                   
                        return fomrs_id != 'blog_editform';
                    } 
                }      
            },           
            blog_status :{
                required: true,
            }            

        },
        messages: {
            title: {
                required: "Please Enter Title",
            },
            content: {
                required: "Please Enter content",
            },
            blog_icon: {
                required: "Please Choose Blog image",   
            },
            blog_status:{
                required: "Please Select Status",
            }            
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }

    });


    var res;
    $.validator.addMethod('username_rule', function(value,element){
        var urlss = base_url +'admin/check-user-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uname', username: value, _token: csrf_token},
            //dataType: "html",  
            async: false,
            success:function(response) {   
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }
                //res = (response !== 'true') ? false : true;
            }            
        }); 
        return res;    
    },'Username is already taken.');

    $.validator.addMethod('email_rule', function(value,element){
        var urlss = base_url +'admin/check-user-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uemail', useremail: value, _token: csrf_token},
            //dataType: "html",
            async: false,  
            success:function(response) {   
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }
                //res = (response !== 'true') ? false : true;
            }            
        }); 
        return res;    
    },'Email is already taken.'); 

    $.validator.addMethod('email_custom_rule', function(value,element){
        var urlss = base_url +'admin/check-email-existance';
        $.ajax({        
            url: urlss,
            method: 'POST',
            data: {existance_type: 'uemail', useremail: value, _token: csrf_token},
            //dataType: "html",
            async: false,  
            success:function(response) {  //alert(response); 
                if(response !== 'true'){                
                    res = false;
                } else {
                    res = true;
                }                
            }            
        }); 
        return res;    
    },'Email is already taken.');

    
});


///////////Summer Notes//////////////
$(function () {
    $('#content').summernote({
        height: 100,        
        callbacks: {
            onInit: function (c) {
                c.editable.html('');
            }
        }
    })
});
//////Summernote Validation on form Submittion////////////
$( "#add_new_blog_form" ).submit(function( event ) {
        
    $('#content-summernote-error').remove();
    $('.note-editable.card-block').css('border', '');

    if($("#content").summernote("isEmpty") == true){
        
        $('<span id="content-summernote-error" class="content-summernote-error">Please Enter Description</span>').insertAfter(".note-editor");
        $('.note-editable.card-block').css('border','1px solid red');
        return false;       

    } 
});



//////Resest errors and reset from when close////////
$('.modal').on('hidden.bs.modal', function() {

    //Change From_id and Form_Action
    //var originurl   = window.location.origin;  
    //alert( $(this).find('form').attr("id") );  
    if($(this).find('form').attr("id") == 'add_new_parentcat_form' || $(this).find('form').attr("id") == 'parentcat_editform'){
        //alert('parent');
        $(this).find('form').attr("id","add_new_parentcat_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-parentcat');
        $("#modal-default .modal-header .modal-title").html('Add Parent Category');
        $('.hidden_input_catid').remove();

        var $catform = $('#add_new_parentcat_form');
        $catform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $catform.find('.error').removeClass('error');
        $catform.find('.is-invalid').removeClass('is-invalid');  
        $('.show_cat_icon').attr('src',"");

    } 
    
    else if($(this).find('form').attr("id") == 'add_new_childcat_form' || $(this).find('form').attr("id") == 'childcat_editform') {
        //alert('child');
        $(this).find('form').attr("id","add_new_childcat_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-childcat');
        $("#modal-default .modal-header .modal-title").html('Add Child Category');
        $('.hidden_input_catid').remove();

        var $catform = $('#add_new_childcat_form');
        $catform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $catform.find('.error').removeClass('error');
        $catform.find('.is-invalid').removeClass('is-invalid'); 
        $('.show_cat_icon').attr('src',"");

    } else if($(this).find('form').attr("id") == 'add_new_subchild_form' || $(this).find('form').attr("id") == 'subchildcat_editform') {
        //alert('Sub-child');
        $(this).find('form').attr("id","add_new_subchild_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-subchildcat');
        $("#modal-default .modal-header .modal-title").html('Add Sub-Child Category');
        $('.hidden_input_catid').remove();

        var $catform = $('#add_new_subchild_form');
        $catform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $catform.find('.error').removeClass('error');
        $catform.find('.is-invalid').removeClass('is-invalid'); 
        $('.show_cat_icon').attr('src',"");

        
    } else if($(this).find('form').attr("id") == 'add_new_subadmin_form' || $(this).find('form').attr("id") == 'subadmin_editform'){

        $(this).find('form').attr("id","add_new_subadmin_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-subadmin');
        $("#modal-default .modal-header .modal-title").html('Add Subadmin');
        $('.hidden_input_catid').remove();

        var $subadminform = $('#add_new_subadmin_form');
        $subadminform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $subadminform.find('.error').removeClass('error');
        $subadminform.find('.is-invalid').removeClass('is-invalid'); 

    } else if($(this).find('form').attr("id") == 'add_new_user_form' || $(this).find('form').attr("id") == 'users_editform'){

        $(this).find('form').attr("id","add_new_user_form");  
        $(this).find('form').attr("action",base_url+'admin/insert-users');
        $("#modal-default .modal-header .modal-title").html('Add User');
        //$('.hidden_input_catid').remove();

        var $userform = $('#add_new_user_form');
        $userform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $userform.find('.error').removeClass('error');
        $userform.find('.is-invalid').removeClass('is-invalid'); 

    } else if($(this).find('form').attr("id") == 'add_new_blog_form' || $(this).find('form').attr("id") == 'blog_editform'){

        $(this).find('form').attr("id","add_new_blog_form");  
        $(this).find('form').attr("action",base_url+'admin/create-blog');
        $("#modal-default .modal-header .modal-title").html('Add Blog');
        //$('.hidden_input_catid').remove();

        var $blogform = $('#add_new_blog_form');
        $blogform.validate().resetForm();
        $(this).find('form').trigger('reset');
        $blogform.find('.error').removeClass('error');
        $blogform.find('.is-invalid').removeClass('is-invalid'); 

    }
    
      
    
});



//////Open popup for Edit Users ///////////
$("body").on("click", ".admin_edit_users", function (e) {

    e.preventDefault();
    var userid = $(this).attr('user_id');            //alert(userid);
    var first_name = $(this).attr('first_name');        //alert(first_name);
    var last_name = $(this).attr('last_name');
    var email = $(this).attr('email');      //alert(useremail);
    var country = $(this).attr('country');      //alert(country);
    var user_status = $(this).attr('user_status');      //alert(userstatus); 

    $('.modal').modal('show');
    //Change From_id and Form_Action    
    $('#modal-default').find('form').attr("id","users_editform");  
    $('#modal-default').find('form').attr("action",base_url+'admin/edit-users');  

    $("#modal-default .modal-header .modal-title").html('Edit User');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_user_id" value='+userid+' class="hidden_user_id">';
    $(".firstname").after(input_hidden);

    $('.firstname').val(first_name);
    $('.lastname').val(last_name);
    $('.email').val(email);
    $('.country').val(country);
    if (user_status == 'active'){
        $('.user_status_active').prop('checked', true);
    } else {
        $('.user_status_inactive').prop('checked', true);
    }  


});

//////Open popup for Edit Parent category ///////////
$("body").on("click", ".admin_edit_categories", function (e) {
    
    e.preventDefault();

    // var validator = $( "#edit_parentcat_form" ).validate();
    // validator.resetForm();
    
    var cat_type = $(this).attr('cat_type');  

    if(cat_type == 'parent'){
        
        var cat_id = $(this).attr('cat_id');            //alert(cat_id);
        var cat_name = $(this).attr('cat_name');        //alert(cat_name);
        var cat_icon_path = $(this).attr('icon_path');
        var cat_icon = $(this).attr('cat_icon');        //alert(cat_icon);
        var cat_status = $(this).attr('cat_status');   //alert(cat_status);
        
        $('.modal').modal('show');
        //Change From_id and Form_Action
        //var originurl   = window.location.origin;
        //var newaction = formaction.slice(0, formaction.lastIndexOf('/')); //base_url
        $('#modal-default').find('form').attr("id","parentcat_editform");  
        $('#modal-default').find('form').attr("action",base_url+'admin/edit-parentcat');  

        $("#modal-default .modal-header .modal-title").html('Edit Parent Category');

        var input_hidden = '<input type="hidden" name="hidden_cat_id" value='+cat_id+' class="hidden_input_catid">';
        $(".parent_cat_name").after(input_hidden);
        
        $('.parent_cat_name').val(cat_name);
        if (cat_status == 'active'){
            $('.cat_status_active').prop('checked', true);
        } else {
            $('.cat_status_inactive').prop('checked', true);
        }  
        $('.show_cat_icon').attr('src',cat_icon_path+'/'+cat_icon);

    } else if(cat_type == 'child') {
        
        var child_id = $(this).attr('child_id');            //alert(child_id);
        var child_name = $(this).attr('child_name');        //alert(child_name);
        var child_icon_path = $(this).attr('icon_path');
        var child_icon = $(this).attr('child_icon');        //alert(child_icon);
        var child_status = $(this).attr('child_status');   //alert(child_status);
        var parent_id = $(this).attr('parent_id');
        
        $('.modal').modal('show');
        //Change From_id and Form_Action        
        $('#modal-default').find('form').attr("id","childcat_editform");  
        $('#modal-default').find('form').attr("action",base_url+'admin/edit-childcat');  

        $("#modal-default .modal-header .modal-title").html('Edit Child Category');

        var input_hidden = '<input type="hidden" name="hidden_child_id" value='+child_id+' class="hidden_input_catid">';
        $(".child_cat_name").after(input_hidden);
        
        $('.child_cat_name').val(child_name);        
        $("#parent_id option[value='"+parent_id+"']").attr("selected", "selected");        

        if (child_status == 'active'){
            $('.child_status_active').prop('checked', true);
        } else {
            $('.child_status_inactive').prop('checked', true);
        }     
        $('.show_cat_icon').attr('src',child_icon_path+'/'+child_icon);

    } else {

        var subchild_id = $(this).attr('subchild_id');            //alert(subchild_id);
        var subchild_name = $(this).attr('subchild_name');        //alert(subchild_name);
        var subchild_parent_id = $(this).attr('subchild_parent_id');
        var subchild_child_id = $(this).attr('subchild_child_id'); //alert(subchild_child_id);
        var subchild_icon_path = $(this).attr('icon_path');
        var subchild_icon = $(this).attr('subchild_icon');        //alert(subchild_icon);
        var subchild_status = $(this).attr('subchild_status');   //alert(subchild_status);

        $('.modal').modal('show');

        //Change From_id and Form_Action
        var originurl   = window.location.origin;
        $('#modal-default').find('form').attr("id","subchildcat_editform");  
        $('#modal-default').find('form').attr("action",base_url+'admin/edit-subchildcat');  

        $("#modal-default .modal-header .modal-title").html('Edit Sub-Child Category');
        
        var input_hidden = '<input type="hidden" name="hidden_subchild_id" value='+subchild_id+' class="hidden_input_catid">';
        $(".subchild_cat_name").after(input_hidden);

        $('.subchild_cat_name').val(subchild_name);        
        $("#subchild_parent_id option[value='"+subchild_parent_id+"']").attr("selected", "selected");  
        
        GetChild_Of_ParentCat(subchild_parent_id);   
        setTimeout(function() {     
            $("#subchild_child_id option[value='"+subchild_child_id+"']").attr("selected", "selected");
        }, 1000);        

        if (subchild_status == 'active'){
            $('.subchild_status_active').prop('checked', true);
        } else {
            $('.subchild_status_inactive').prop('checked', true);
        }     
        $('.show_cat_icon').attr('src',subchild_icon_path+'/'+subchild_icon);        

    }    

});

//////Open popup for Edit SubAdmin ///////////
$("body").on("click", ".admin_edit_subadmin", function (e) {

    e.preventDefault();
    var userid = $(this).attr('userid');            //alert(userid);
    var username = $(this).attr('username');        //alert(username);
    var useremail = $(this).attr('useremail');      //alert(useremail);
    var userphone = $(this).attr('userphone');      //alert(userphone);
    var userstatus = $(this).attr('userstatus');      //alert(userstatus); 

    $('.modal').modal('show');
    //Change From_id and Form_Action
    //var originurl   = window.location.origin;
    $('#modal-default').find('form').attr("id","subadmin_editform");  
    $('#modal-default').find('form').attr("action",base_url+'admin/edit-subadmin');  

    $("#modal-default .modal-header .modal-title").html('Edit Subadmin');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_subadmin_id" value='+userid+' class="hidden_subadmin_id">';
    $(".subadmin_name").after(input_hidden);

    $('.subadmin_name').val(username);
    $('.subadmin_email').val(useremail);
    $('.subadmin_mobile').val(userphone);
    if (userstatus == 'active'){
        $('.subadmin_status_active').prop('checked', true);
    } else {
        $('.subadmin_status_inactive').prop('checked', true);
    }  

});


//////////Open popup for Edit Blog////////////
$("body").on("click", ".admin_edit_blog", function (e) {

    e.preventDefault();
    var blog_id = $(this).attr('blog_id');            //alert(blog_id);
    var blog_title = $(this).attr('blog_title');      //alert(blog_title);
    var blog_content = $(this).attr('blog_content');        //alert(useremail);
    var blog_icon_path = $(this).attr('blog_icon_path');
    var blog_image = $(this).attr('blog_icon');        //alert(userphone);
    var blogstatus = $(this).attr('blog_status');      //alert(blogstatus); 

    $('.blog_modal').modal('show');
    //Change From_id and Form_Action
    //var originurl   = window.location.origin;
    $('#modal-default').find('form').attr("id","blog_editform");  
    $('#modal-default').find('form').attr("action",base_url+'admin/edit-blog');  

    $("#modal-default .modal-header .modal-title").html('Edit Blog');
    //Add hidden field for subadmin ID
    var input_hidden = '<input type="hidden" name="hidden_blog_id" value='+blog_id+' class="hidden_blog_id">';
    $(".title").after(input_hidden);

    $('.title').val(blog_title); 

    // $('#content').html(blog_content); 
    $('#content').summernote({
        height: 100
    }).summernote('code', blog_content);


    if (blogstatus == 'active'){
        $('.blog_status_active').prop('checked', true);
    } else {
        $('.blog_status_inactive').prop('checked', true);
    }  

    $('.show_cat_icon').attr('src',blog_icon_path+'/'+blog_image);

});



//Ajax For Get Parent Category
$('body').on('change','#subchild_parent_id', function(){

    var parent_ids = $(this).val(); //alert(parent_ids);
    GetChild_Of_ParentCat(parent_ids);   

});

function GetChild_Of_ParentCat(parent_ids){

    var urlss = base_url +'admin/get-child-acc-to-parent';    
    //var parent_ids = $(this).val();
    $.ajax({        
        url: urlss,
        method: 'POST',
        data: {parent_id : parent_ids, _token : csrf_token},
        dataType: "json",    
        success:function(response) {             
            //alert(response.status);
            if(response.status == 'success'){
                var select_option = '';
                $.each(response.datas, function( index, value ) {
                    //alert( value.id + ": " + value.child_name );
                    select_option += "<option value='"+value.id+"'>"+ value.child_name +"</option>";                                        
                });                
                $('#subchild_child_id').html(select_option);
            }
        },
        error: function(response) {
        }
    });

}


////////Show image befoe upload//////////
$('.cat-file-input').change(function(){
    var curElement = $('.show_cat_icon');
    console.log(curElement);
    var reader = new FileReader();

    reader.onload = function (e) {
        // get loaded data and render thumbnail.
        curElement.attr('src', e.target.result);
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});