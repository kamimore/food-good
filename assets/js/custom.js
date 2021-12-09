jQuery('#frmRegister').on('submit',function(e){
  jQuery('.error_field').html('');
  jQuery('#register_submit').attr('disabled',true);
  jQuery('#form_msg').html('Please wait');

jQuery.ajax({

url:user_login+'login_register_submit',
type:'post',
data:jQuery('#frmRegister').serialize(),
success:function(result){
  var data=jQuery.parseJSON(result);
  jQuery('#register_submit').attr('disabled',false);

  if(data['status']=='error'){
    jQuery(`#${data['field']}`).html(`${data['msg']}`);

  }
  if(data['status']=='success')
  {

    jQuery(`#${data['field']}`).html(`${data['msg']}`);
    jQuery('#frmRegister').trigger('reset');


  }


}


});
e.preventDefault();



});

jQuery('#frmLogin').on('submit',function(e){
	jQuery('.error_field').html('');
	jQuery('#login_submit').attr('disabled',true);
	jQuery('#form_login_msg').html('Please wait...');
	jQuery.ajax({
		url:user_login+'login_register_submit',
		type:'post',
		data:jQuery('#frmLogin').serialize(),
		success:function(result){
			jQuery('#form_login_msg').html('');
			jQuery('#login_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#form_login_msg').html(data.msg);
			}
      var is_checkout=jQuery('#is_checkout').val();
      if(is_checkout=='yes')
      {
        window.location.href='checkout';

      }else if(data.status=='success'){
				//jQuery('#form_login_msg').html(data.msg);
				window.location.href='shop';
			}
		}

	});
	e.preventDefault();
});

jQuery('#frmForgotPassword').on('submit',function(e){
	jQuery('#forgot_submit').attr('disabled',true);
	jQuery('#form_forgot_msg').html('Please wait...');
	jQuery.ajax({
		url:user_login+'login_register_submit',
		type:'post',
		data:jQuery('#frmForgotPassword').serialize(),
		success:function(result){
			jQuery('#form_forgot_msg').html('');
			jQuery('#forgot_submit').attr('disabled',false);
      console.log(result);
			var data=jQuery.parseJSON(result);
			if(data.status=='error'){
				jQuery('#form_forgot_msg').html(data.msg);
			}
			if(data.status=='success'){
				jQuery('#form_forgot_msg').html(data.msg);
				//window.location.href='shop';
			}
		}

	});
	e.preventDefault();
});




 function set_checkbox(id){
    data=$('#checked_input').val();
    var check=data.search(`-${id}`);
    if(check!=-1){
      input_value=data.replace("-"+id,"");


    }else{

      input_value=`${data}-${id}`;
    }

   $('#checked_input').val(input_value);


    $("#checked_form").submit();



 }
 function run_dish(respect)
 {
  data=$('#type_dish').val(respect);
  $("#checked_form").submit();

 }

 function add_to_cart(id,type)
 {

   var qty=jQuery(`#qty${id}`).val();
   console.log(`#qty${id}`);
   console.log(qty);

   var attr=jQuery(`input[name=radio_fun${id}]:checked`).val();

if(typeof attr==='undefined' || qty==0)
{
  swal("Error", "Please choose correctly", "error");

}
else{


   jQuery.ajax({
     url:user_login+'manage_cart',
     type:'post',
     data:'qty='+qty+'&attr='+attr+'&type='+type,
     success:function(data){
       var data=$.parseJSON(data);
       swal("Thanks!", "Dish added successfully", "success");

       jQuery('#shop_added_msg_'+attr).html(`(Added-${qty})`);
       //var totalCartDish=jQuery('#totalCartDish').val();

       jQuery('#totalCartDish').html(data.totalCartDish);
       jQuery('#totalCartPrice').html(`Rs ${data.totalCartPrice}`);

       var tp1=data.totalCartPrice;
       if(data.totalCartDish==1){
         var tp=qty*data.price;
         var html='<div class="shopping-cart-content"><ul id="cart_ul"><li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="javascript:void(0)"><img alt=""  id="maintain_width" src="'+load+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span>Rs '+tp+' </span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li></ul><h4>Total : <span class="shop-total" id="shopTotal">'+tp1+' Rs</span></h4><div class="shopping-cart-btn"><a href="cart">view cart</a><a href="checkout">checkout</a></div></div>';
         jQuery('.header-cart').append(html);
       }
       else{
         var tp=qty*data.price;

         jQuery("#attr_"+attr).remove();
         var html='<li class="single-shopping-cart" id="attr_'+attr+'"><div class="shopping-cart-img"><a href="#"><img  id="maintain_width" alt="" src="'+load+data.image+'"></a></div><div class="shopping-cart-title"><h4><a href="javascript:void(0)">'+data.dish+'</a></h4><h6>Qty: '+qty+'</h6><span> Rs '+tp+'</span></div><div class="shopping-cart-delete"><a href="javascript:void(0)" onclick=delete_cart("'+attr+'")><i class="ion ion-close"></i></a></div></li>';
         jQuery('#cart_ul').append(html);
         jQuery('#shopTotal').html(tp1+ 'Rs');
       }


       //setTimeout(function(){
         //document.location.reload();
         // },3000);
     }


   });
 }

}


function delete_cart(id,is_type="noload"){
	jQuery.ajax({
		url:user_login+'manage_cart',
		type:'post',
		data:'attr='+id+'&type=delete',
		success:function(result){
      if(is_type=="load")
      {
        window.location.reload();
      }
      else{
			var data=jQuery.parseJSON(result);
			//swal("Congratulation!", "Dish added successfully", "success");
			jQuery('#totalCartDish').html(data.totalCartDish);
			jQuery('#shop_added_msg_'+id).html('');

			if(data.totalCartDish==0){
				jQuery('.shopping-cart-content').remove();
				jQuery('#totalCartPrice').html('');
			}
      else{
				var tp1=data.totalCartPrice;
				jQuery('#shopTotal').html('Rs ' +tp1);
				jQuery('#attr_'+id).remove();
				jQuery('#totalCartPrice').html('Rs '+data.totalCartPrice);
			}
}
		}
	});
}

jQuery('#frmProfile').on('submit',function(e){
	jQuery('#profile_submit').attr('disabled',true);
	jQuery('#form_msg').html('Please wait...');
	jQuery.ajax({
		url:user_login+'update_profile',
		type:'post',
		data:jQuery('#frmProfile').serialize(),
		success:function(result){
			jQuery('#form_msg').html('');
			jQuery('#profile_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				jQuery('#user_top_name').html(jQuery('#uname').val());
				swal("Success Message", data.msg, "success");
			}
		}
	});
	e.preventDefault();
});

jQuery('#frmPassword').on('submit',function(e){
	jQuery('#password_submit').attr('disabled',true);
	jQuery('#password_form_msg').html('Please wait...');
	jQuery.ajax({
		url:user_login+'update_profile',
		type:'post',
		data:jQuery('#frmPassword').serialize(),
		success:function(result){

			jQuery('#password_form_msg').html('');
			jQuery('#password_submit').attr('disabled',false);
			var data=jQuery.parseJSON(result);
			if(data.status=='success'){
				swal("Success Message", data.msg, "success");
			}
			if(data.status=='error'){
				swal("Error Message", data.msg, "error");
			}
		}
	});
	e.preventDefault();
});


function apply_coupon(){
	var coupon_code=jQuery('#coupon_code').val();
  jQuery('#coupon_code_msg').html('Please wait');
	if(coupon_code==''){
		jQuery('#coupon_code_msg').html('Please enter coupon code');
	}else{
		jQuery.ajax({
			url:user_login+'apply_coupon',
			type:'post',
			data:'coupon_code='+coupon_code,
			success:function(result){
        jQuery('#coupon_code_msg').html('');
				var data=jQuery.parseJSON(result);
				if(data.status=='success'){
					swal("Success Message", data.msg, "success");
					jQuery('.shopping-cart-total').show();

          jQuery('#coupon_code_msg').html(`${coupon_code}:Coupon code Applied`);
          jQuery('#couponItem').css({'cursor':'not-allowed'});
          jQuery('#couponItem').attr('disabled','disabled');

					jQuery('.coupon_code_str').html(coupon_code);
					jQuery('.final_price').html(data.coupon_code_apply+' Rs');
				}
				if(data.status=='error'){
					swal("Error Message", data.msg, "error");
				}
			}
		})
	}
}

function updaterating(id,oid){
	var rate=jQuery('#rate'+id).val();
	var rate_str=jQuery('#rate'+id+' option:selected').text();

	if(rate==''){
		//jQuery('#coupon_code_msg').html('Please enter coupon code');
	}else{
		jQuery.ajax({
			url:user_login+'updaterating',
			type:'post',
			data:'id='+id+'&rate='+rate+'&oid='+oid,
			success:function(result){
				jQuery('#rating'+id).html("<div class='set_rating'>"+rate_str+"</div>");
			}
		})
	}
}

function setSearch(){
	jQuery('#search_str').val(jQuery('#search').val());
	jQuery('#checked_form').submit();
}

function copyfunction(){
  //alert($('.copy_text').text());
  var item=$('.copy_text')

  const txt=$('.copy_text').text();
  item.select();
  //item.setSelectionRange(0, 99999); /* For mobile devices */
  navigator.clipboard.writeText(item.text());
    alert(`Referral link copied`);
}
