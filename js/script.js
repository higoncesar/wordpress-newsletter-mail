jQuery(function ($) {
    let nmail_urlHash = 'subscriptions';

    let window_urlHash = window.location.hash;

    if(window_urlHash){
        window_urlHash = window_urlHash.substr(1);
    
        if(window_urlHash!== nmail_urlHash){
            nmail_urlHash = window_urlHash
        }
    }else{
        window.location.hash=nmail_urlHash;
    }
    
    let nmail_activeTab = "";
    
    $('a.nav-tab').click(function (e) {
        
        if($(this).attr('data-tab-name') !== nmail_activeTab){
            $('div.nmail-tab-container[data-tab-name="' + nmail_activeTab + '"]').hide();
            $('a.nav-tab[data-tab-name="' + nmail_activeTab + '"]').removeClass('nav-tab-active');
            nmail_activeTab = $(this).attr('data-tab-name');
            $('div.nmail-tab-container[data-tab-name="' + nmail_activeTab + '"]').show();
            $(this).addClass('nav-tab-active');
        }
    });
    
    $('a.nav-tab[data-tab-name="' + nmail_urlHash + '"]').trigger('click');
});