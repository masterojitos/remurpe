                        <div class="row-fluid channel-playlist">
                            <section class="span7 channel-player">
                                <div id="video-player"></div>
                            </section>
                            <section class="span5 channel-videos">
                                <?php if (count($videos) > 0) { echo '<div' . (count($videos) > 4 ? ' class="videos-scroll"' : '') . '>'; echo "\r"; } ?>
                                    <ul class="nav">
                                        <?php foreach ($videos as $video) { echo "\r"; ?>
                                        <li<?php if (isset($video_id) && $video['id'] == $video_id) echo ' class="active"'; ?>>
                                            <figure>
                                                <img src="thumbnail.php?file=<?php echo $video['file']; ?>.png" alt="<?php echo $video['video_canonical']; ?>" title="<?php echo $video['title']; ?>" />
                                                <figcaption>
                                                    <h3><?php echo $video['title']; ?></h3>
                                                    <p><?php echo $video['duration']; ?></p>
                                                </figcaption>
                                            </figure>
                                            <a href="https://www.facebook.com/sharer/sharer.php?s=100&p[url]=<?php echo api_get_path(WEB_PATH); ?>main/webtv/shared.php?code=<?php echo shared_url(); ?>,<?php echo $video['id']; ?>&p[title]=<?php echo $video['title']; ?>&p[summary]=<?php echo $video['description']; ?>" class="facebook">
                                                <img src="images/fb_icons.png" alt="<?php echo get_lang('Share'); ?> Facebook" class="no_clickable" />
                                            </a>
                                            <?php if (api_is_allowed_to_edit()) { echo "\r"; ?>
                                            <div class="video-actions">
                                                <?php
                                                echo returnIcon('dk-icon-action-status-' . ($video['status'] == 1 ? 'white' : 'gray'), '', 'index.php?'.  api_get_cidreq().'&action=change_status_video&id=' . $video['id'], 'Change video status', 'change-status', array("icons" => "dk-icon-action-status-white/dk-icon-action-status-gray"));
                                                echo returnIcon('dk-icon-action-edit-white', '', 'index.php?'.  api_get_cidreq().'&action=edit_video&id=' . $video['id'], 'Edit video');
                                                echo returnIcon('dk-icon-action-delete-white', '', 'index.php?'.  api_get_cidreq().'&action=delete_video&id=' . $video['id'], 'Delete video', 'action-delete', array("redirect" => "false"));
                                                echo returnIcon('dk-icon-action-facebook-f-' . ($video['shared_status'] == 1 ? 'white' : 'gray'), '', 'index.php?'.  api_get_cidreq().'&action=change_shared_status&id=' . $video['id'], 'Change shared status', 'change-status', array("icons" => "dk-icon-action-facebook-f-white/dk-icon-action-facebook-f-gray"));
                                                echo returnIcon('dk-icon-action-copy-clipboard', '', api_get_path(WEB_PATH). 'main/webtv/shared.php?code=' . shared_url() . ',' . $video['id'], 'Copy clipboard shared link', 'copy-clipboard');
                                                echo "\n";
                                                ?>
                                            </div>
                                            <?php } echo "\n"; ?>
                                        </li>
                                        <?php } echo "\n"; ?>
                                    </ul>
                                <?php if (count($videos) > 0) { echo '</div>'; } echo "\n"; ?>
                            </section>
                        </div>