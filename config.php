<?php

/**
 * Provides information used at run time to display the form and generate signatures.
 */

$config = array(

  // Edit the paths below to reflect the location of the generator as well as
  // the image assets. These locations must be publicly accessible on the Web.
  // Include a trailing slash after each.

  'installation' => array(
    'base_url' => 'https://example.com/signature/',
    'image_path' => 'https://example.com/signature/images/',
    'headshot_path' => 'https://example.com/signature/images/headshots/',
  ),
  
  // Edit the values below to change the static content inserted in all
  // signatures. Users must regenerate and reinstall signatures for changes
  // to be reflected.
  // - For 'website', exclude the protocol (https://) and the trailing slash.
  // - For all other URLs, include the protocol
 
  'static_values' => array(
    'phone_office' => '(703) 883-0500',
    'website' => 'sahouri.com',
    'rate_url' => 'https://hubs.ly/H0lHF9g0',
    'news_url' => 'https://hubs.ly/H0lHFwQ0',
    'blog_url' => 'https://hubs.ly/H0lHFx00',
    'linkedin_url' => 'https://hubs.ly/H0lHFxL0',
    'youtube_url' => 'https://hubs.ly/H0lHGkj0',
    'facebook_url' => 'https://hubs.ly/H0lHFzT0',
    'twitter_url' => 'https://hubs.ly/H0lHFyN0',
  ),
  
  // Edit the values below to change the text that appears in the
  // generator web page's user interface.
  
  'ui_text' => array(
    'last_update' => '<p><em>Updated Nov. 12, 2019</em></p>',  
    'introduction' => '<div class="alert alert-primary" role="alert">For best results, use this app only in Google Chrome.</div>',
    'review_instructions' => '<p>Check the signature below carefully for accuracy. Click the Generate signature button again after making changes.</p>',
    'instructions_outlookwin' => '<ol><li>Click the button below to copy the HTML for your signature.</li><li>Open a new email message in Outlook.</li><li>On the <strong>Message</strong> menu, click the <strong>Signature</strong> icon then select <strong>Signatures</strong>.</li><li>Under <cite>Select signature to edit</cite>, choose <strong>New</strong>, and in the <cite>New Signature</cite> dialog box, type a name for your signature.</li><li>Under <cite>Edit signature</cite>, paste your new signature.</li><li>Change the default signature settings as desired.</li><li>Click <strong>OK</strong>.</li></ol>',
  ),
  
  // Use caution when editing the values below.
  // - Values for #title and #placeholder are used only by the form UI
  //   and have no impoct on functionslity.
  // - Changes to other values can break the generator and/or
  //   trigger PHP errors.

  'template_file' => 'signature.tpl.php',

  'form' => array(
    'name' => array(
      '#type' => 'textfield',
      '#title' => 'Name',
      '#required' => TRUE,
    ),
    'title' => array(
      '#type' => 'textfield',
      '#title' => 'Title',
      '#required' => TRUE,
    ),
    'phone_direct' => array(
      '#type' => 'textfield',
      '#title' => 'Direct phone',
      '#required' => TRUE,
      '#placeholder' => '(703) 555-1212',
    ),
    'email' => array(
      '#type' => 'textfield',
      '#title' => 'Email',
      '#required' => TRUE,
    ),
    'headshot' => array(
      '#type' => 'textfield',
      '#title' => 'Headshot filename',
      '#required' => TRUE,
      '#placeholder' => 'jane-doe.png',
    ),
    'meeting_url' => array(
      '#type' => 'textfield',
      '#title' => 'Book a Meeting URL (optional)',
      '#required' => FALSE,
      '#placeholder' => 'https://example.com/',
    ),
  ),
    
);

/**
 * Override installation settings when the generator is running
 * in a dev/test environment. Delete or comment after deployment.
 */

// $config['installation']['base_url'] = '';
// $config['installation']['image_path'] = '';
// $config['installation']['headshot_path'] = '';
