<?php

    namespace IdnoPlugins\Sketch {

        class ContentType extends \Idno\Common\ContentType {

            public $title = 'Sketch';
            public $category_title = 'Sketches';
            public $entity_class = 'IdnoPlugins\\Sketch\\Sketch';
            public $indieWebContentType = array('photo','picture');

        }

    }