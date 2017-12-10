<?php
/**
* Returns the social button list for.
*/
function get_social_button_list() {
  $output = '';
  $social_buttons = array(
    array('field' => 'options_facebook_url',    'icon' => 'fa-facebook-official',    'title' => 'Follow Us On Facebook'),
    array('field' => 'options_google_plus_url', 'icon' => 'fa-google-plus-official', 'title' => 'Follow Us On Google Plus'),
    array('field' => 'options_twitter_url',     'icon' => 'fa-twitter',              'title' => 'Follow Us On Twitter'),
    array('field' => 'options_linkedin_url',    'icon' => 'fa-linkedin',             'title' => 'Follow Us On LinkedIn'),
    array('field' => 'options_pinterest_url',   'icon' => 'fa-pinterest',            'title' => 'Follow Us On Pinterest'),
    array('field' => 'options_instagram_url',   'icon' => 'fa-instagram',            'title' => 'Follow Us On Instagram'),
    array('field' => 'options_snapchat_url',    'icon' => 'fa-snapchat-ghost',       'title' => 'Follow Us On Snapchat'),
    array('field' => 'options_flickr_url',      'icon' => 'fa-flickr',               'title' => 'Follow Us On Flickr'),
    array('field' => 'options_youtube_url',     'icon' => 'fa-youtube',              'title' => 'Follow Us On YouTube'),
    array('field' => 'options_vimeo_url',       'icon' => 'fa-vimeo',                'title' => 'Follow Us On Vimeo'),
    array('field' => 'options_soundcloud_url',  'icon' => 'fa-soundcloud',           'title' => 'Follow Us On SoundCloud'),
    array('field' => 'options_etsy_url',        'icon' => 'fa-etsy',                 'title' => 'Follow Us On Etsy'),
    array('field' => 'options_tumblr_url',      'icon' => 'fa-tumblr',               'title' => 'Follow Us On Tumblr'),
    array('field' => 'options_reddit_url',      'icon' => 'fa-reddit-alien',         'title' => 'Follow Us On Reddit'),
    array('field' => 'options_houzz_url',       'icon' => 'fa-houzz',                'title' => 'Follow Us On Houzz'),
    array('field' => 'options_yelp_url',        'icon' => 'fa-yelp',                 'title' => 'Follow Us On Yelp'),
    );
  $output .= '<ul class="social-button-list">';
  foreach ($social_buttons as $sb) {
    if(get_field($sb['field'],'options')) {$output .= '<li><a class="social-button" href="'.get_field($sb['field'],'options').'" title="'.__($sb['title']).'" target="_blank"><i class="fa fa-fw '.$sb['icon'].'"></i></a></li>';}
  }
  $output .= '</ul>';
  return $output;
}

/**
* Options Address Output Function
*/
function get_the_address($format = 'inline', $icons = true) {
  $html = '';
  $options_email_address = get_field('options_email_address','options');
  $options_phone_number = get_field('options_phone_number','options');
  $options_fax_number = get_field('options_fax_number','options');
  $options_toll_free_number = get_field('options_toll_free_number','options');
  $options_street_address = get_field('options_street_address','options');
  $options_city = get_field('options_city','options');
  $options_province = get_field('options_province','options');
  $options_country = get_field('options_country','options');
  $options_postal_code = get_field('options_postal_code','options');
  if ($icons) {
    switch ($format) {
      case 'mailing':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= ', ' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= ', ' . $options_country;}
      if($options_postal_code){$html .= ', ' . $options_postal_code;}
      return $html;
      break;

      case 'mailing-stacked':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= '<br>' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= '<br>' . $options_country;}
      if($options_postal_code){$html .= '<br>' . $options_postal_code;}
      return $html;
      break;

      case 'street':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= ', ' . $options_city;}
      return $html;
      break;

      case 'phone':
      if($options_phone_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_phone_number.'"><i class="fa fa-fw fa-phone"></i>&nbsp;'.$options_phone_number.'</a>';}
      return $html;
      break;

      case 'tollfree':
      if($options_toll_free_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_toll_free_number.'"><i class="fa fa-fw fa-phone"></i>&nbsp;'.$options_toll_free_number.'</a>';}
      return $html;
      break;

      case 'fax':
      if($options_fax_number){$html .= '<a title="'.__('Send Us A Fax').'" href="tel:'.$options_fax_number.'"><i class="fa fa-fw fa-fax"></i>&nbsp;'.$options_fax_number.'</a>';}
      return $html;
      break;

      case 'email':
      if($options_email_address){$html .= '<a title="'.__('Send Us An Email').'" href="mailto:'.$options_email_address.'"><i class="fa fa-fw fa-envelope"></i>&nbsp;'.$options_email_address.'</a>';}
      return $html;
      break;

      default:
      if($options_phone_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_phone_number.'"><i class="fa fa-fw fa-phone"></i>&nbsp;'.$options_phone_number.'</a><br>';}
      if($options_toll_free_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_toll_free_number.'"><i class="fa fa-fw fa-phone"></i>&nbsp;'.$options_toll_free_number.'</a><br>';}
      if($options_fax_number){$html .= '<a title="'.__('Send Us A Fax').'" href="tel:'.$options_fax_number.'"><i class="fa fa-fw fa-fax"></i>&nbsp;'.$options_fax_number.'</a><br>';}
      if($options_email_address){$html .= '<a title="'.__('Send Us An Email').'" href="mailto:'.$options_email_address.'"><i class="fa fa-fw fa-envelope"></i>&nbsp;'.$options_email_address.'</a><br>';}
      if($options_street_address){$html .= '<br>' . $options_street_address;}
      if($options_city){$html .= '<br>' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= '<br>' . $options_country;}
      if($options_postal_code){$html .= '<br>' . $options_postal_code;}

      return $html;
    }
  } else {
    switch ($format) {
      case 'mailing':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= ', ' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= ', ' . $options_country;}
      if($options_postal_code){$html .= ', ' . $options_postal_code;}
      return $html;
      break;

      case 'mailing-stacked':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= '<br>' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= '<br>' . $options_country;}
      if($options_postal_code){$html .= '<br>' . $options_postal_code;}
      return $html;
      break;

      case 'street':
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= ', ' . $options_city;}
      return $html;
      break;

      case 'phone':
      if($options_phone_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_phone_number.'">'.$options_phone_number.'</a>';}
      return $html;
      break;

      case 'tollfree':
      if($options_toll_free_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_toll_free_number.'">'.$options_toll_free_number.'</a>';}
      return $html;
      break;

      case 'fax':
      if($options_fax_number){$html .= '<a title="'.__('Send Us A Fax').'" href="tel:'.$options_fax_number.'">'.$options_fax_number.'</a>';}
      return $html;
      break;

      case 'email':
      if($options_email_address){$html .= '<a title="'.__('Send Us An Email').'" href="mailto:'.$options_email_address.'">'.$options_email_address.'</a>';}
      return $html;
      break;

      default:
      if($options_phone_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_phone_number.'">'.$options_phone_number.'</a><br>';}
      if($options_toll_free_number){$html .= '<a title="'.__('Give Us A Call').'" href="tel:'.$options_toll_free_number.'">'.$options_toll_free_number.'</a><br>';}
      if($options_fax_number){$html .= '<a title="'.__('Send Us A Fax').'" href="tel:'.$options_fax_number.'">'.$options_fax_number.'</a><br>';}
      if($options_email_address){$html .= '<a title="'.__('Send Us An Email').'" href="mailto:'.$options_email_address.'">'.$options_email_address.'</a><br>';}
      if($options_street_address){$html .= $options_street_address;}
      if($options_city){$html .= '<br>' . $options_city;}
      if($options_province){$html .= ', ' . $options_province;}
      if($options_country){$html .= '<br>' . $options_country;}
      if($options_postal_code){$html .= '<br>' . $options_postal_code;}

      return $html;
    }
  }
}
