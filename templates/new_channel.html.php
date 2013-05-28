                        <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            <div class="span12">
                                <div class="row-fluid">
                                    <section class="span5 manage-channel">
                                        <h2><?php echo get_lang('Channel'); ?></h2>
                                        <div class="control-group">
                                            <label for="channel_name" class="control-label"><?php echo get_lang('Name'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="channel[name]" id="channel_name" class="input-block-level" placeholder="<?php echo get_lang('Name'); ?>" required="required" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="channel_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                            <div class="controls">
                                                <textarea name="channel[description]" id="channel_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"></textarea>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="channel_image" class="control-label"><?php echo get_lang('SelectCoverImage'); ?></label>
                                            <div class="controls">
                                                <input type="file" name="channel[image]" class="invisible">
                                                <div class="input-append">
                                                    <input type="text" id="channel_image" class="mo_file input-large" placeholder="<?php echo get_lang('CoverImage'); ?>" readonly="readonly" required="required" />
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
                                                <input type="hidden" name="channel[status]" value="1" />
                                            </div>
                                        </div>
                                        <?php echo display_progressbar(true); ?>
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
                                                <input type="hidden" name="catalogue[status]" value="1" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="catalogue_price" class="control-label"><?php echo get_lang('PriceForChannel'); ?></label>
                                            <div class="controls">
                                                <input type="text" name="catalogue[price]" id="catalogue_price" placeholder="<?php echo get_lang('Price'); ?>" />
                                                <div data-toggle="buttons-radio" class="btn-group btn-group-inverse">
                                                    <button data-toggle="button" class="btn" value="EUR" type="button">¤</button>
                                                    <button data-toggle="button" class="btn" value="USD" type="button">$</button>
                                                </div>
                                                <input type="hidden" name="catalogue[currency]" value="EUR" />
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label class="control-label"><?php echo get_lang('AccessDuration'); ?></label>
                                            <div class="controls">
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="1" data-max="20"></div>
                                                    <input type="text" name="catalogue[duration][days]" value="1" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('Days'); ?></small>
                                                </div>
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="0" data-max="20"></div>
                                                    <input type="text" name="catalogue[duration][weeks]" value="0" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('Weeks'); ?></small>
                                                </div>
                                                <div class="row-fluid catalogue-duration">
                                                    <div class="mo-slider" data-min="0" data-max="20"></div>
                                                    <input type="text" name="catalogue[duration][months]" value="0" readonly="readonly" />
                                                    <small class="text-right muted"><?php echo get_lang('MinMonths'); ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group">
                                            <label for="catalogue_description" class="control-label"><?php echo get_lang('Description'); ?></label>
                                            <div class="controls">
                                                <textarea name="catalogue[description]" id="catalogue_description" class="input-block-level" placeholder="<?php echo get_lang('Description'); ?>"></textarea>
                                            </div>
                                        </div>
                                    </section>
                                </div>
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <button class="btn btn-primary pull-right" type="submit"><?php echo get_lang('Submit'); ?></button>
                                    </div>
                                </div>
                            </div>
                        </form>