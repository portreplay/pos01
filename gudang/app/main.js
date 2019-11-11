$(function(){
	var update_profile = $('#update_profile');

	update_profile.click(function(){
		 BootstrapDialog.show({
            title: 'Perbaharui Data Anda ',
            message: $('<div></div>').load('modal/form-update-profile.php'),
            animate: false,
            type:  BootstrapDialog.TYPE_INFO,
                onhide: function() {
                    
            }
        });
	});

});