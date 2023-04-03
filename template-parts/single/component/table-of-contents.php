<?php

// Get the content of the webpage
$content = get_the_content();

// Find all heading elements in the content
$heading_results = array();
$num_headings = preg_match_all("~(<h([2-6]))(.*?>(.*)<\/h[2-6]>)~", $content, $heading_results);

// If there are less than 1 headings, return the content as-is
if( $num_headings < 1 ) {
  return $content;
}

// Create a list of links to the headings
$link_list = "";
for ($i = 0; $i < $num_headings; ++$i) {
  $title = filter_var( $heading_results[4][$i], FILTER_SANITIZE_SPECIAL_CHARS );
  $link_list .= "<li class='heading-level-" . $heading_results[2][$i] .
    "'><a href='#" . sanitize_title( $title ) . "'>" . $title . "</a></li>";
}

// Get some configuration options for the TOC
$heading_toc = narasix_get_option('heading_toc');

// Use default value for TOC heading if none is provided
if(!$heading_toc) {
  $heading_toc = 'Table of Contents';
}

// Create the TOC
$start_nav = "<details class='not-wysiwyg bg-charcoal-100 open:bg-charcoal-100 open:ring-charcoal-100/5 dark:bg-charcoal-700 dark:open:bg-charcoal-700 dark:open:ring-charcoal-700/10 mb-4 rounded-lg p-6 open:shadow-lg open:ring-1'>";
$end_nav = "</details>";
$title = "<summary class='text-charcoal-700 dark:text-charcoal-100 select-none text-lg font-semibold leading-6'>" . $heading_toc . "</summary>";
$link_list = "<ul class='toc space-y-1 text-md text-charcoal-700 dark:text-charcoal-100 list-none'>" . $link_list . "</ul>";
$table_of_contents = $start_nav . $title . $link_list . $end_nav;

// Output the TOC
$allowed_html = array(
  'details' => array(
      'class' => array(),
      'open' => array(),
  ),
  'summary' => array(
      'class' => array(),
  ),
  'ul' => array(
      'class' => array(),
  ),
  'li' => array(
      'class' => array(),
  ),
  'a' => array(
      'href' => array(),
  )
);
echo wp_kses( $table_of_contents, $allowed_html );


