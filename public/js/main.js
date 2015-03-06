$(function(){
    initSelectAllBrowsers();
    initCreateReportForm();
    initAdminBrowserSelect()
});
function initAdminBrowserSelect(){
    if($('.browsers-page').length === 0){
        return;
    }
    $('.select-all').click(function(){
        var $el = $(this);
        console.log($el.is(':checked'));
        if($el.is(':checked')){
            $('input[type="checkbox"]').prop('checked', true);
        }
        else{
            $('input[type="checkbox"]').prop('checked', false);
            //$('input[type="checkbox"]').removeAttr('checked');
        }
    });
    $('.enable-selected').click(function(){
        $('input[name="action"]').val('enable');
        $('form').submit();
    });
    $('.disable-selected').click(function(){
        $('input[name="action"]').val('disable');
        $('form').submit();
    });


}
function initSelectAllBrowsers(){
    $('.select-all-browsers').click(function(){
        var $el = $(this);
        var $panelBody = $el.closest('.panel-body');
        $panelBody.find('input[type="checkbox"]').each(function(){
            $(this).click();
        });
    });
}
function initCreateReportForm(){
    if( $('#create_report_form').length == 0 ) return;
    var $schedule = $('#schedule').datetimepicker({
        defaultDate: moment()
    });
}
