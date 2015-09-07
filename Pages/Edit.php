<?php

    namespace IdnoPlugins\Sketch\Pages {

        class Edit extends \Idno\Common\Page {

            function getContent() {

                $this->createGatekeeper();    // This functionality is for logged-in users only

                // Are we loading an entity?
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Sketch\Sketch::getByID($this->arguments[0]);
                } else {
                    $object = new \IdnoPlugins\Sketch\Sketch();
                }

                $t = \Idno\Core\site()->template();
                $body = $t->__(array(
                    'object' => $object
                ))->draw('entity/Sketch/edit');

                if (empty($object)) {
                    $title = 'Upload a sketch';
                } else {
                    $title = 'Edit sketch details';
                }

                if (!empty($this->xhr)) {
                    echo $body;
                } else {
                    $t->__(array('body' => $body, 'title' => $title))->drawPage();
                }
            }

            function postContent() {
                $this->createGatekeeper();

                $new = false;
                if (!empty($this->arguments)) {
                    $object = \IdnoPlugins\Sketch\Sketch::getByID($this->arguments[0]);
                }
                if (empty($object)) {
                    $object = new \IdnoPlugins\Sketch\Sketch();
                }

                if ($object->saveDataFromInput($this)) {
                    $this->forward(\Idno\Core\site()->config()->getDisplayURL() . 'content/all/');
                    //$this->forward($object->getDisplayURL());
                }

            }

        }

    }