<?php
//---------------------------------------------------------------
# get the fields inputed for flexible content blocks
function get_flex_content(){
  global $post;
  $html = '';
  if($flex_contents = get_field('flex_content')){
    foreach($flex_contents as $flex_content){
      switch($flex_content['acf_fc_layout']){
        case 'full_width' :
          $html .= flex_full_width($flex_content);
        break;
        case 'two_column' :
          $html .= flex_two_col($flex_content);
        break;
        case 'three_column' :
          $html .= flex_three_col($flex_content);
        break;
        case 'four_column' :
          $html .= flex_four_col($flex_content);
        break;
      }
    }
  }
  return $html;
}
//---------------------------------------------------------------
function flex_full_width($flex_content){
  $html = '';
  $html .= '<div class="clear">';
  $html .= apply_filters( 'the_content', $flex_content['content'] );
  $html .= '</div>';
  return $html;
}
//---------------------------------------------------------------
function flex_two_col($flex_content){
  $html = '';
  $html .= '<div class="clear">';
  $html .= '<div class="two-col">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $html .= '<div class="two-col">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $html .= '</div>';
  return $html;
}
//---------------------------------------------------------------
function flex_three_col($flex_content){
  $html = '';
  $html .= '<div class="clear">';
  $html .= '<div class="three-col">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $html .= '<div class="three-col">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $html .= '<div class="three-col">'.apply_filters( 'the_content', $flex_content['column3'] ).'</div>';
  $html .= '</div>';
  return $html;
}
//---------------------------------------------------------------
function flex_four_col($flex_content){
  $html = '';
  $html .= '<div class="clear">';
  $html .= '<div class="four-col">'.apply_filters( 'the_content', $flex_content['column1'] ).'</div>';
  $html .= '<div class="four-col">'.apply_filters( 'the_content', $flex_content['column2'] ).'</div>';
  $html .= '<div class="four-col">'.apply_filters( 'the_content', $flex_content['column3'] ).'</div>';
  $html .= '<div class="four-col">'.apply_filters( 'the_content', $flex_content['column4'] ).'</div>';
  $html .= '</div>';
  return $html;
}
