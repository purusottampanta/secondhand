<?php


/**
 * @param        $route
 * @param        $title
 * @param        $text
 * @param string $class
 * @param string $iclass
 * @param string $value
 * @return string
 */
function getDeleteForm($route, $title, $text, $class = 'btn btn-icon-toggle', $iclass = 'fa fa-trash', $value = '')
{
    // $token = csrf_field();
    // $field = method_field('DELETE');
    // 
    // you have to add below form component after </a> if you want to use sweetalert.js
    // now using bootstrat modal so no need 
    // 
    // <form action="$route" method='post' style="display:none;" class="delete-form">
    //     $token
    //     $field
    // </form>
    return <<<HTML
    <a class="confirm-delete $class" type='button' data-title="$title" data-text='$text' data-toggle="modal" data-route="$route" data-target="#ConfirmDeleteModal" data-keyboard="false" data-backdrop="static">
        <i class="$iclass opacity-75"></i> $value
    </a>
    
HTML;
}

/**
 * @param        $route
 * @param        $title
 * @param        $text
 * @param        $label
 * @param string $class
 * @return string
 */
function getConfirmDialog($route, $title, $text, $class = '', $iclass = '', $hover_title = '' )
{
    return <<<HTML
    <a type="button" title="$hover_title" data-route="$route" data-title="$title" data-text="$text" class="confirm-alert {$class}" data-target ="#showConfirmation" data-keyboard="false" data-toggle="modal" data-backdrop="static"><i class= "$iclass"></i></a>
HTML;
}
