$(document).on('click', '.modal-response', function(e) {
    e.preventDefault();
    const andon_id = $(this).data('andon-id');
    const andon_main_alert = $(this).data('andon-main-alert');
    const andon_alert_child = $(this).data('andon-aler-child');
    const andon_asset = $(this).data('andon-asset');
    const andon_work_center = $(this).data('andon-work-center');
    const andon_pn = $(this).data('andon-pn');
    const andon_wo = $(this).data('andon-wo');
    const andon_site = $(this).data('andon-site');

    $("#andon_id").text(action_name);
    $("#andon_main_alert").val(action_id);
    $("#action-andon_alert_child").val(action_name);
    $("#andon_asset").val(issue_name);
    $("#ecd").val(ecd);
    //$("#owner").val(owner);

 

    
});
