<?php
/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */

 return [
    //------------ Home ------------
    "home" => "overview",

    //------------ Max Page Depth ------------
    // e.g when set to 3:
    //   - documentations
    //     - chapters
    //       - subchapters
    "max_page_depth" => 3,


    //------------ Enable Cache ------------
    "cache" => true,


    //------------ Smartypants ------------
    "smartypants" => true,


    //------------ File Upload and Images ------------
    // NOTE: if you change one of these settings clear your thumbs folder
    "image" => [
        "resize_on_upload" => true,
        "max_file_size"    => 1048576, // in Byte
        "widths"           => [480, 1280, 2560, 3840], // NOTE: images wider than biggest defined image size and bigger than maximum defined image file size get resized when resize_on_upload is set
        "images_per_row"   => [
            "half"    => 2,
            "quarter" => 4
        ],
    ],


    //------------ Video ------------
    "kirbytext" => [
        "video" => [
            "class" => "embed-responsive-item"
        ]
    ],


    //------------ Sourcecode Tag ------------
    "sourcecode" => [
        "max_file_size" => 10000, // in Byte
    ],


    //------------ Panel Semesters Tag ------------
    "departmentLongName" => [
        "KG" => "Kommunikationsgestaltung",
        "IG" => "Interaktionsgestaltung",
        "PG" => "Produktgestaltung",
        "IoT" => "Internet der Dinge",
        "SG" => "Strategische Gestaltung",
    ],


    //------------ Custom File DragTexts ------------
    // List of elements for which the dragText should be customized
    // key   -> file extension or kirby defined file type NOTE: file extension gets checked before file type
    // value -> type of tag
    // A list of supported file types can be found here: https://getkirby.com/docs/guide/content/files#example-page-with-files__supported-file-types
    "customFileDragTexts" => [
        "js"    => "p5",
        "video" => "video",
        "audio" => "mp3",
        "image" => "image"
    ],


    //------------ Panel ------------
    "panel" => [
        "language" => "de",
        "install"  => true
    ],


    //------------ Markdown ------------
    "markdown" => [
        "extra" => true
    ],


    //------------ Columnify Plugin ------------
    "columnify" => [
        "default" => [
            "element_class"     => "col offset-md-1 offset-lg-2  offset-xl-2",
            "placeholder_classes" => [
                "d-none d-lg-block col-lg-1 col-xl-3",
                "w-100"
            ]
        ],
        // define elements that should be columnified and define their element and placeholder class, if only element name is defined default classes are chosen
        "elements" => [
            "p.important"          => [
                "element_class"     => "col-11 col-md-10 col-lg-8 offset-lg-1 col-xl-6 offset-xl-1 lead font-weight-semibold",
                "placeholder_classes" => "d-none d-md-block col-md-1 col-lg-2 col-xl-4"
            ],
            "p",
            "h1",
            "h2",
            "h3",
            "h4",
            "hr",
            "ul",
            "ol",
            "figure",
            "blockquote",
            "code-accordion",
            "div.embedded-gist",
            "audio",

            "div.image.default",
            "div.image.big"        => [
                "element_class"       => "col-11 col-md-10 offset-md-1 col-lg-10 offset-lg-1 col-xl-8 offset-xl-1",
                "placeholder_classes" => "d-none d-xl-block col-xl-2"
            ],
            "div.image.first" => [
                "element_class"       => "col-11 col-md-5 col-lg offset-md-1 offset-xl-1",
                "placeholder_classes" => false
            ],
            "div.image.between.even" => [
                "element_class"       => "col-11 col-md-5 col-lg offset-md-1 offset-lg-0",
                "placeholder_classes" => false
            ],
            "div.image.between" => [
                "element_class"       => "col-11 col-md-5 col-lg",
                "placeholder_classes" => false
            ],
            "div.image.last.even" => [
                "element_class"       => "col-11 col-md-5 col-lg offset-md-1 offset-lg-0",
                "placeholder_classes" => [
                    "d-none d-xl-block col-xl-2",
                    "w-100"
                ]
            ],
            "div.image.last" => [
                "element_class"       => "col-11 col-md-5 col-lg",
                "placeholder_classes" => [
                    "d-none d-xl-block col-xl-2",
                    "w-100"
                ]
            ]
        ]
    ],
    'google-oauth' => [
        // Set the default role of newly created users.
        'defaultRole' => 'editor',
    ],

];
