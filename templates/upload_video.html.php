                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="span12">
                                <div class="row-fluid">
                                    <section class="span6 upload-video">
                                        <p class="alert alert-info"><?php echo get_lang('YourVideoWillBeVisibleOnAnyDevice'); ?></p>
                                        <div class="control-group">
                                            <label for="video_file" class="control-label"><?php echo get_lang('SelectVideo'); ?></label>
                                            <div class="controls">
                                                <input type="file" name="video[file]" class="invisible">
                                                <div class="input-append">
                                                    <input type="text" id="video_file" class="mo_file input-large" placeholder="<?php echo get_lang('SelectVideo'); ?>" required="required" readonly="readonly" />
                                                    <a class="btn" href="#"><?php echo get_lang('Browse'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="video_title" class="control-label"><?php echo get_lang('Title'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="video[title]" id="video_title" class="input-block-level" placeholder="<?php echo get_lang('Title'); ?>" required="required" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="video_keywords" class="control-label"><?php echo get_lang('SearchKeywords'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="video[keywords]" id="video_keywords" class="input-block-level tag-it" placeholder="<?php echo get_lang('SearchKeywords'); ?>" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="video_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                            <div class="controls">
                                                <textarea name="video[description]" id="video_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="video_channel" class="control-label"><?php echo get_lang('Channel'); ?></label>
                                            <div class="controls">
                                                <select name="video[channel]" id="video_channel" class="input-block-level">
                                                    <?php
                                                    echo '<option value="0">' . get_lang('ChooseChannel') . '</option>';
                                                    foreach ($channels as $channel) {
                                                        $selected = $channel_id == $channel['id'] ? ' selected="selected"' : '';
                                                        echo '<option value="' . $channel['id'] . '" ' . $selected . '>' . $channel['name'] . '</option>';
                                                    }
                                                    echo "\n";
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php echo display_progressbar(true); ?>
                                    </section>
                                </div>
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <button class="btn btn-primary pull-right" type="submit"><?php echo get_lang('Submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>