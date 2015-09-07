<?= $this->draw('entity/edit/header'); ?>
    <form action="<?= $vars['object']->getURL() ?>" method="post" enctype="multipart/form-data">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 edit-pane">

                <h4>
                    <?php

                        if (empty($vars['object']->_id)) {
                            ?>New Sketch<?php
                        } else {
                            ?>Edit Sketch<?php
                        }

                    ?>
                </h4>
                    <?php

                        if (empty($vars['object']->_id)) {

                            ?>
                                <div id="sketch-preview"></div>
                                <p>
                                    <span class="btn btn-primary btn-file">
                                        <i class="fa fa-pencil"></i> <span id="sketch-filename">Select a sketch</span> <input type="file" name="sketch" id="sketch"
                                                                                    class="span9"
                                                                                    accept="image/*;capture=camera"
                                                                                    onchange="sketchPreview(this)"/>

                                    </span>
                                </p>
                        <?php

                        }

                    ?>
                <div class="content-form">
                    
                    <label for="title">
                        Title</label>
                        <input type="text" name="title" id="title" class="form-control"
                               value="<?= htmlspecialchars($vars['object']->title) ?>"
                               placeholder="Give it a title"/>
                </div>

                    <label>
                        Description<br/>
                        <textarea name="body" id="description" class="content-entry mentionable form-control"
                                  placeholder="Add a caption"><?= htmlspecialchars($vars['object']->body) ?></textarea>
                    </label>

                <?=$this->draw('entity/tags/input');?>
                <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('image'); ?>
               
                <p class="button-bar ">
                    <?= \Idno\Core\site()->actions()->signForm('/sketch/edit') ?>
                    <input type="button" class="btn btn-cancel" value="Cancel" onclick="hideContentCreateForm();"/>
                    <input type="submit" class="btn btn-primary" value="Publish"/>
                    <?= $this->draw('content/access'); ?>
                </p>
            </div>

        </div>
    </form>
    <script>
        //if (typeof sketchPreview !== function) {
        function sketchPreview(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#sketch-preview').html('<img src="" id="sketchpreview" style="display:none; width: 400px">');
                    $('#sketch-filename').html('Choose different sketch');
                    $('#sketchpreview').attr('src', e.target.result);
                    $('#sketchpreview').show();
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        //}
    </script>
<?= $this->draw('entity/edit/footer'); ?>