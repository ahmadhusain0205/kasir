<?php
function login()
{
    $ci = get_instance();
    if (isset($_SESSION['username'])) {
        // $ci->db->query('update log_activity set time_logout = ' . time() . ' where id in (select max(id) from log_activity order by id desc) and user_id = '.$ci->session->userdata('user_id'));
        $ci->db->query('update log_activity set time_logout = ' . time() . ' where user_id = ' . $ci->session->userdata('user_id'));
        $x = $ci->session->userdata('user_id');
        $offline = 0;
        $ci->db->set('on_off', $offline);
        $ci->db->where('user_id', $x);
        $ci->db->update('user');
        $ci->session->unset_userdata('username');
        $ci->session->unset_userdata('id_role');
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-primary" role="alert">
                terima kasih!
            </div>'
        );
        redirect('Auth');
    }
}
function logout()
{
    $ci = get_instance();
    if (!isset($_SESSION['username'])) {
        $ci->session->set_flashdata(
            'message',
            '<div class="alert alert-danger" role="alert">
                    isikan form login terlebih dahulu!
                </div>'
        );
        redirect('Auth');
    }
}
