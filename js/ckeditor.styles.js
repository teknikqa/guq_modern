/*
 Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 For licensing, see LICENSE.html or http://ckeditor.com/license
 */

/*
 * This file is used/requested by the 'Styles' button.
 * The 'Styles' button is not enabled by default in DrupalFull and DrupalFiltered toolbars.
 */
if (typeof (CKEDITOR) !== 'undefined') {
  CKEDITOR.addStylesSet('drupal',
          [
            /* Block Styles */

            // These styles are already available in the "Format" drop-down list, so they are
            // not needed here by default. You may enable them to avoid placing the
            // "Format" drop-down list in the toolbar, maintaining the same features.
            /*
             { name : 'Paragraph'		, element : 'p' },
             { name : 'Heading 1'		, element : 'h1' },
             { name : 'Heading 2'		, element : 'h2' },
             { name : 'Heading 3'		, element : 'h3' },
             { name : 'Heading 4'		, element : 'h4' },
             { name : 'Heading 5'		, element : 'h5' },
             { name : 'Heading 6'		, element : 'h6' },
             { name : 'Preformatted Text', element : 'pre' },
             { name : 'Address'			, element : 'address' },
             */
            {name: 'Lead text', element: 'p', attributes: {'class': 'lead'}},
            {name: 'Small', element: 'small'},
            {name: 'Well', element: 'div', attributes: {'class': 'well'}},
            {name: 'White Well', element: 'div', attributes: {'class': 'well white-well'}},
            {name: 'Callout Tertiary Dark Red', element: 'p', attributes: {'class': 'bs-callout bs-callout-red'}},
            {name: 'Callout Georgetown Gray', element: 'p', attributes: {'class': 'bs-callout bs-callout-gray'}},
            {name: 'Callout Secondary Bright Blue', element: 'p', attributes: {'class': 'bs-callout bs-callout-blue'}},
            {name: 'Tagline', element: 'p', attributes: {'class': 'bs-callout bs-callout-tagline'}},
            {name: 'More Link', element: 'a', attributes: {'class': 'more'}},
            {name: 'Solid Gray line', element: 'hr', attributes: {'class': 'solid-line'}},
            {name: 'Solid Blue line', element: 'hr', attributes: {'class': 'blue-line'}},
            {name: 'Dotted line', element: 'hr', attributes: {'class': 'dotted-line'}},
            {name: 'Double line', element: 'hr', attributes: {'class': 'double-line'}},
//            { name : 'Blue Title'		, element : 'h3', styles : { 'color' : 'Blue' } },
//            { name : 'Red Title'		, element : 'h3', styles : { 'color' : 'Red' } },

            /* Inline Styles */

            // These are core styles available as toolbar buttons. You may opt enabling
            // some of them in the "Styles" drop-down list, removing them from the toolbar.
            /*
             { name : 'Strong'			, element : 'strong', overrides : 'b' },
             { name : 'Emphasis'			, element : 'em'	, overrides : 'i' },
             { name : 'Underline'		, element : 'u' },
             { name : 'Strikethrough'	, element : 'strike' },
             { name : 'Subscript'		, element : 'sub' },
             { name : 'Superscript'		, element : 'sup' },
             */

            /*
             { name : 'Marker: Yellow'	, element : 'span', styles : { 'background-color' : 'Yellow' } },
             { name : 'Marker: Green'	, element : 'span', styles : { 'background-color' : 'Lime' } },
             
             { name : 'Big'				, element : 'big' },
             { name : 'Small'			, element : 'small' },
             { name : 'Typewriter'		, element : 'tt' },
             
             { name : 'Computer Code'	, element : 'code' },
             { name : 'Keyboard Phrase'	, element : 'kbd' },
             { name : 'Sample Text'		, element : 'samp' },
             { name : 'Variable'			, element : 'var' },
             
             { name : 'Deleted Text'		, element : 'del' },
             { name : 'Inserted Text'	, element : 'ins' },
             
             { name : 'Cited Work'		, element : 'cite' },
             { name : 'Inline Quotation'	, element : 'q' },
             
             { name : 'Language: RTL'	, element : 'span', attributes : { 'dir' : 'rtl' } },
             { name : 'Language: LTR'	, element : 'span', attributes : { 'dir' : 'ltr' } },
             */

            /* Object Styles */

            {
              name: 'Image on Left',
              element: 'img',
              attributes:
                      {
                        'style': 'padding: 0 15px 15px 0;',
                        'class': 'pull-left',
                        'border': '0',
                        'align': 'left'
                      }
            },
            {
              name: 'Image on Right',
              element: 'img',
              attributes:
                      {
                        'style': 'padding: 0 0 15px 15px;',
                        'class': 'pull-right',
                        'border': '0',
                        'align': 'left'
                      }
            },
            {
              name: 'Image with Rounded Edges',
              element: 'img',
              attributes:
                      {
                        'class': 'img-rounded'
                      }
            },
            {
              name: 'Circled Image',
              element: 'img',
              attributes:
                      {
                        'class': 'img-circle'
                      }
            },
            {
              name: 'Image with Border',
              element: 'img',
              attributes:
                      {
                        'class': 'img-thumbnail'
                      }
            }
          ]);
//  editor.ui.addButton('Abbr', {
//    label: 'Insert Abbreviation',
//    command: 'abbrDialog',
//    toolbar: 'insert'
//  });
}

