                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="span12">
                                <div class="row-fluid">
                                    <section class="span12 edit-video">
                                        <article class="row-fluid">
                                            <div class="span3">
                                                <div class="cover-image" title="<?php echo $video['thumbnail_canonical']; ?>"><img src="thumbnail.php?file=<?php echo $video['file']; ?>.png" /></div>
                                            </div>
                                            <div class="span7">
                                                <div class="control-group">
                                                    <label for="video_file" class="control-label"><?php echo get_lang('ChangeVideo'); ?></label>
                                                    <div class="controls">
                                                        <input type="file" name="video[file]" class="invisible" />
                                                        <div class="input-append">
                                                            <input type="text" id="video_file" class="mo_file input-block-level" placeholder="<?php echo $video['video_canonical'] . '.' . $video['type']; ?>" readonly="readonly" />
                                                            <a class="btn" href="#"><?php echo get_lang('Browse'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_title" class="control-label"><?php echo get_lang('Title'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[title]" id="video_title" value="<?php echo $video['title']; ?>" class="input-block-level" placeholder="<?php echo get_lang('Title'); ?>" required="required" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_keywords" class="control-label"><?php echo get_lang('SearchKeywords'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[keywords]" id="video_keywords" value="<?php echo $video['keywords']; ?>" class="input-block-level tag-it" placeholder="<?php echo get_lang('SearchKeywords'); ?>" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                                    <div class="controls">
                                                        <textarea name="video[description]" id="video_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"><?php echo $video['description']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_channel" class="control-label"><?php echo get_lang('Channel'); ?></label>
                                                    <div class="controls">
                                                        <select name="video[channel]" id="video_channel" class="input-block-level">
                                                            <?php
                                                            echo '<option value="0">' . get_lang('ChooseChannel') . '</option>';
                                                            foreach ($channels as $channel) {
                                                                $selected = $video['channel_id'] == $channel['id'] ? ' selected="selected"' : '';
                                                                echo '<option value="' . $channel['id'] . '" ' . $selected . '>' . $channel['name'] . '</option>';
                                                            }
                                                            echo "\n";
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label"><?php echo get_lang('Status'); ?></label>
                                                    <div class="controls">
                                                        <div data-toggle="buttons-radio" class="btn-group btn-group-inverse">
                                                            <button data-toggle="button" class="btn" value="1" type="button"><?php echo get_lang('langVisible'); ?></button>
                                                            <button data-toggle="button" class="btn" value="0" type="button"><?php echo get_lang('Hidden'); ?></button>
                                                        </div>
                                                        <input type="hidden" name="video[status]" value="<?php echo $video['status']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_duration" class="control-label"><?php echo get_lang('Duration'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[duration]" id="video_duration" value="<?php echo $video['duration']; ?>" class="input-small" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_views" class="control-label"><?php echo get_lang('Views'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[views]" id="video_views" value="<?php echo $video['views']; ?>" class="input-small" placeholder="<?php echo get_lang('Views'); ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <?php echo display_progressbar(true); ?>
                                                <a href="index.php?<?php echo api_get_cidreq(); ?>&action=delete_video&id=<?php echo $video_id; ?>" class="btn btn-link action-delete pull-right" data-redirect="true"><?php echo get_lang('DeleteVideo'); ?></a>
                                            </div>
                                            <div class="span1 offset1"></div>
                                        </article>
                                    </section>
                                </div>
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <button class="btn btn-primary pull-right" type="submit"><?php echo get_lang('Submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="video[id]" value="<?php echo $video_id; ?>" />
                        </form>