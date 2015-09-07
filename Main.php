<?php

    namespace IdnoPlugins\Sketch {

        class Main extends \Idno\Common\Plugin {

            function registerPages() {
                \Idno\Core\site()->addPageHandler('/sketch/edit/?', '\IdnoPlugins\Sketch\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/sketch/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Sketch\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/sketch/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Sketch\Pages\Delete');
            }

            /**
             * Get the total file usage
             * @param bool $user
             * @return int
             */
            function getFileUsage($user = false) {

                $total = 0;

                if (!empty($user)) {
                    $search = ['user' => $user];
                } else {
                    $search = [];
                }

                if ($sketches = Sketch::get($search,[],9999,0)) {
                    foreach($sketches as $sketch) {
                        /* @var Sketch $sketch */
                        if ($attachments = $sketch->getAttachments()) {
                            foreach($attachments as $attachment) {
                                $total += $attachment['length'];
                            }
                        }
                    }
                }

                return $total;

            }

        }

    }