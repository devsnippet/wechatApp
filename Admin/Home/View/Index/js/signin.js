$(function () {
	jQuery.support.placeholder = false;
	test = document.createElement('input');
	if('placeholder' in test) jQuery.support.placeholder = true;
	if (!$.support.placeholder) {
		$('.field').find ('label').show ();
	}
    $('.loginBtn').click(function(){
        var pwd = $('#loginForm input[name=password]').val();
        var usr = $('#loginForm input[name=username]').val();
        var loginData = {'usr':usr,'pwd':hex_md5(hex_md5(pwd))};
        $.post('index.php/home/index/login',loginData,function(data){
            alert(data);
        });
    });
});