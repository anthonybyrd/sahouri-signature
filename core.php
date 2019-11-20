<?php

require_once('config.php');

if (isset($_REQUEST['s']) && $_REQUEST['s'] == 'mode') {
  if (!$form_error = validate_submission($_POST)) {
    $sig_html = mail_signature();
    $output = entry_form(FALSE, $sig_html);
  } else {
    $output = entry_form($form_error);
  }
} else {
  $output = entry_form();
}

function mail_signature() {
  global $config;

  if ($template = file_get_contents($config['template_file'])) {
    $values = array();
    foreach ($_POST as $key => $val) {
      if (array_key_exists($key, $config['form'])) {
        $values[$key] = strip_tags($val);
      }
    }
    
    $values = $values + $config['static_values'];
    $values = $values + $config['installation'];
    
    extract($values);
		ob_start();                    // Start output buffering
		include($config['template_file']);  // Include the file
		$contents = ob_get_contents(); // Get the contents of the buffer
		ob_end_clean();                // End buffering and discard
		return $contents;              // Return the content;
  }
}

function validate_submission($form_state) {
  global $config;
  foreach ($config['form'] as $key => $field) {
    if ($field['#required'] && (!isset($form_state[$key]) || empty($form_state[$key]))) {
      return 'Please complete all required fields.';
    }
  }
}

function entry_form($form_error = FALSE, $sig_html = '') {
  global $config;
  
  $output = "<h3>1. Customize</h3>";
  
  if ($form_error) {
    $output .= "<p><em>{$form_error}</em></p>\n";
  }
  
  $output .= "<div><form method=\"post\">";

  foreach ($config['form'] as $key => $field) {
    $field_title = ($field['#required']) ? $field['#title'] . '*' : $field['#title'];

    $previous = (isset($_POST[$key])) ? $_POST[$key] : '';
    if (!empty($field['#default_value']) && empty($previous)) {
    	$default_value = $field['#default_value'];
    } else {
    	$default_value = $previous;
    }
    
    $placeholder = (isset($field['#placeholder'])) ? $field['#placeholder'] : '';

    if ($field['#type'] == 'textfield') {
      $output .= "<div><strong>{$field_title}</strong><br />";
      $output .= "<input type=\"{}\" name=\"{$key}\" size=\"40\" value=\"{$default_value}\" placeholder=\"{$placeholder}\"/></div>";
    } elseif ($field['#type'] == 'select') {
      $output .= "<div><strong>{$field_title}</strong><br />";
      $output .= "<select name=\"{$key}\" size=\"1\">";
        foreach ($field['#options'] as $option => $value) {
          if ($default_value == $option) {
            $selected = "selected=\"selected\"";
          } else {
            $selected = "";
          }
          $output .= "<option value=\"{$option}\" {$selected}>{$value}</option>";
        }
      $output .= "</select></div>";
    } else if ($field['#type'] == 'checkbox') {
    	$output .= "<div><input type=\"checkbox\" name=\"{$key}\" ></div>";
    }
  }

  $output .= "<input type=\"hidden\" name=\"s\" value=\"mode\" />";
  $output .= "<div class=\"cta\"><input type=\"submit\" class=\"btn btn-primary\" value=\"Generate signature\"/></div>";
  
  $output .= "</form></div>";
  
  if (!empty($sig_html)) {
  
    $output .= "<div class=\"signature-html-source-wrapper\"><div id=\"signature-html-source\">{$sig_html}</div></div>";

    $output .= "<h3>2. Review</h3>";
    $output .= $config['ui_text']['review_instructions'];

    $output .= "<div class=\"signature-html-preview-wrapper\"><div>{$sig_html}</div></div>";

    $output .= "<h3>3. Install</h3>";

    $output .= "<div>" . $config['ui_text']['instructions_outlookwin'] . "</div>";

    $output .= "<div class=\"cta\">";
    $output .= "<div class=\"btn btn-secondary\" id=\"btn-copy\" data-toggle=\"tooltip\" data-placement=\"right\" data-clipboard-target=\"#signature-html-source\">Copy to clipboard</div>";
    $output .= "</div>";

  }
  

  return $output;
}