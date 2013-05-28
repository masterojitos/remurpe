                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="span12">
                                <div class="row-fluid">
                                    <section class="span5 manage-channel">
                                        <h2><?php echo get_lang('Channel'); ?></h2>
                                        <div class="control-group">
                                            <label for="channel_name" class="control-label"><?php echo get_lang('Name'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="channel[name]" id="channel_name" value="<?php echo $channel['name']; ?>" class="input-block-level" placeholder="<?php echo get_lang('Name'); ?>" required="required" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="channel_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                            <div class="controls">
                                                <textarea name="channel[description]" id="channel_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"><?php echo $channel['description']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_lang('CoverImage'); ?></label>
                                            <div class="controls">
                                                <div class="cover-image" title="<?php echo $channel['image_canonical']; ?>"><img src="thumbnail.php?file=<?php echo $channel['image']; ?>" /></div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="channel_image" class="control-label"><?php echo get_lang('ReplaceImage'); ?></label>
                                            <div class="controls">
                                                <input type="file" name="channel[image]" class="invisible">
                                                <div class="input-append">
                                                    <input type="text" id="channel_image" class="mo_file input-large" placeholder="<?php echo $channel['image_canonical'] . '.' . $channel['image_type']; ?>" readonly="readonly" />
                                                    <a class="btn" href="#"><?php echo get_lang('Browse'); ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_lang('Status'); ?></label>
                                            <div class="controls">
                                                <div data-toggle="buttons-radio" class="btn-group btn-group-inverse">
                                                    <button data-toggle="button" class="btn" value="1" type="button"><?php echo get_lang('langVisible'); ?></button>
                                                    <button data-toggle="button" class="btn" value="0" type="button"><?php echo get_lang('Hidden'); ?></button>
                                                </div>
                                                <input type="hidden" name="channel[status]" value="<?php echo $channel['status']; ?>" />
                                            </div>
                                        </div>
                                        <?php echo display_progressbar(true); ?>
                                        <a href="index.php?<?php echo api_get_cidreq(); ?>&action=delete_channel&id=<?php echo $channel_id; ?>" class="btn btn-link action-delete" data-redirect="true"><?php echo get_lang('DeleteChannelAndAllContent'); ?></a>
                                    </section>
                                    <section class="span6 offset1 manage-catalogue">
                                        <h2><?php echo get_lang('Catalogue'); ?></h2>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_lang('InCatalogue'); ?></label>
                                            <div class="controls">
                                                <div data-toggle="buttons-radio" class="btn-group btn-group-inverse">
                                                    <button data-toggle="button" class="btn" value="1" type="button"><?php echo get_lang('langYes'); ?></button>
                                                    <button data-toggle="button" class="btn" value="0" type="button"><?php echo get_lang('langNo'); ?></button>
                                                </div>
                                                <input type="hidden" name="catalogue[status]" value="<?php echo $catalogue['status']; ?>" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="catalogue_price" class="control-label"><?php echo get_lang('PriceForChannel'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="catalogue[price]" id="catalogue_price" value="<?php echo $catalogue['price']; ?>" placeholder="<?php echo get_lang('Price'); ?>" />
                                                <div data-toggle="buttons-radio" class="btn-group btn-group-inverse">
                                                    <button data-toggle="button" class="btn" value="EUR" type="button">¤</button>
                                                    <button data-toggle="button" class="btn" value="USD" type="button">$</button>
                                                </div>
                                                <input type="hidden" name="catalogue[currency]" value="<?php echo $catalogue['currency']; ?>" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_lang('AccessDuration'); ?></label>
                                            <div class="controls">
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="1" data-max="20" data-value="<?php echo $duration['days']; ?>"></div>
                                                    <input type="text" name="catalogue[duration][days]" value="<?php echo $duration['days']; ?>" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('Days'); ?></small>
                                                </div>
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="0" data-max="20" data-value="<?php echo $duration['weeks']; ?>"></div>
                                                    <input type="text" name="catalogue[duration][weeks]" value="<?php echo $duration['weeks']; ?>" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('Weeks'); ?></small>
                                                </div>
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="0" data-max="20" data-value="<?php echo $duration['months']; ?>"></div>
                                                    <input type="text" name="catalogue[duration][months]" value="<?php echo $duration['months']; ?>" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('MinMonths'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="catalogue_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                            <div class="controls">
                                                <textarea name="catalogue[description]" id="catalogue_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"><?php echo $catalogue['description']; ?></textarea>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <?php if (count($videos) > 0) { ?>
                                <div class="row-fluid manage-videos-title">
                                    <h2><?php echo get_lang('Videos'); ?></h2>
                                </div>
                                <div class="row-fluid">
                                    <section class="span12 manage-videos">
                                        <?php foreach ($videos as $i => $video) { ?>
                                        <article class="row-fluid">
                                            <div class="span3">
                                                <div class="cover-image" title="<?php echo $video['thumbnail_canonical']; ?>"><img src="thumbnail.php?file=<?php echo $video['file']; ?>.png" /></div>
                                            </div>
                                            <div class="span7">
                                                <div class="control-group">
                                                    <label for="video_file" class="control-label"><?php echo get_lang('ChangeVideo'); ?></label>
                                                    <div class="controls">
                                                        <input type="file" name="video[<?php echo $video['id']; ?>][file]" class="invisible" />
                                                        <div class="input-append">
                                                            <input type="text" id="video_file" class="mo_file input-block-level" placeholder="<?php echo $video['video_canonical'] . '.' . $video['type']; ?>" />
                                                            <a class="btn" href="#"><?php echo get_lang('Browse'); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_title" class="control-label"><?php echo get_lang('Title'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[<?php echo $video['id']; ?>][title]" id="video_title" value="<?php echo $video['title']; ?>" class="input-block-level" placeholder="<?php echo get_lang('Title'); ?>" required="required" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_keywords" class="control-label"><?php echo get_lang('SearchKeywords'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[<?php echo $video['id']; ?>][keywords]" id="video_keywords" value="<?php echo $video['keywords']; ?>" class="input-block-level tag-it" placeholder="<?php echo get_lang('SearchKeywords'); ?>" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                                    <div class="controls">
                                                        <textarea name="video[<?php echo $video['id']; ?>][description]" id="video_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"><?php echo $video['description']; ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_channel" class="control-label"><?php echo get_lang('Channel'); ?></label>
                                                    <div class="controls">
                                                        <select name="video[<?php echo $video['id']; ?>][channel]" id="video_channel" class="input-block-level">
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
                                                        <input type="hidden" name="video[<?php echo $video['id']; ?>][status]" value="<?php echo $video['status']; ?>" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_duration" class="control-label"><?php echo get_lang('Duration'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[<?php echo $video['id']; ?>][duration]" id="video_duration" value="<?php echo $video['duration']; ?>" class="input-small" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label for="video_views" class="control-label"><?php echo get_lang('Views'); ?></label>
                                                    <div class="controls">
                                                        <input type="text" name="video[<?php echo $video['id']; ?>][views]" id="video_views" value="<?php echo $video['views']; ?>" class="input-small" placeholder="<?php echo get_lang('Views'); ?>" readonly="readonly" />
                                                    </div>
                                                </div>
                                                <a href="index.php?<?php echo api_get_cidreq(); ?>&action=delete_video&id=<?php echo $video['id']; ?>" class="btn btn-link action-delete pull-right" data-redirect="false"><?php echo get_lang('DeleteVideo'); ?></a>
                                            </div>
                                            <div class="span1 offset1"></div>
                                        </article>
                                        <?php if ($i + 1 < count($videos)) { ?><hr /><?php } ?>
                                        <?php } echo "\n"; ?>
                                    </section>
                                </div>
                                <?php } ?>
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <button class="btn btn-primary pull-right" type="submit"><?php echo get_lang('Submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="channel[id]" value="<?php echo $channel_id; ?>" />
                            <input type="hidden" name="catalogue[id]" value="<?php echo $catalogue['id']; ?>" />
                        </form>