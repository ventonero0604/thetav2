<?php

// Allow <br> in post titles
add_filter( 'the_title', function( $title ) {
  return str_replace( ['<br>', '<br/>', '<br />'], '<br>', $title );
}, 10, 1 );

add_filter( 'sanitize_title', function( $title ) {
  return str_replace( '<br>', '', $title ); // keep slugs clean
});
