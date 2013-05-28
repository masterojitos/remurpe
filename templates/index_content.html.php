                        <section class="channels" data-sort-url="<?php echo 'index.php?'.  api_get_cidreq().'&action=sort'; ?>">
                            <?php foreach ($articles as $article) { ?><article data-id="<?php echo $article['position_id']; ?>">
                                <?php if ($article['type'] == 'video') { echo "\r"; ?>
                                <div class="video clip" title="<?php echo $article['name']; ?>"><a href="index.php?<?php echo api_get_cidreq(); ?>&action=view_video&id=<?php echo  $article['id']; ?>"><img src="thumbnail.php?file=<?php echo $article['file']; ?>.png" /></a></div>
                                <?php } else if ($article['type'] == 'channel') { echo "\r"; ?>
                                <div class="video" title="<?php echo $article['name']; ?>"><a href="index.php?<?php echo api_get_cidreq(); ?>&action=view_channel&id=<?php echo  $article['id']; ?>"><img src="thumbnail.php?file=<?php echo $article['image']; ?>" /></a></div>
                                <?php } ?>
                                <?php if (api_is_allowed_to_edit()) { echo "\r"; ?>
                                <div class="video-actions">
                                    <?php
                                    echo returnIcon('dk-icon-action-status-' . ($article['status'] == 1 ? 'white' : 'gray'), '', 'index.php?'.  api_get_cidreq().'&action=change_status_' . $article['type'] . '&id=' . $article['id'], 'Change ' . $article['type'] . ' status', 'change-status', array("icons" => "dk-icon-action-status-white/dk-icon-action-status-gray"));
                                    echo returnIcon('dk-icon-action-edit-white', '', 'index.php?'.  api_get_cidreq().'&action=edit_' . $article['type'] . '&id=' . $article['id'], 'Edit ' . $article['type']);
                                    echo returnIcon('dk-icon-action-delete-white', '', 'index.php?'.  api_get_cidreq().'&action=delete_' . $article['type'] . '&id=' . $article['id'], 'Delete ' . $article['type'], 'action-delete', array("redirect" => "false"));
                                    if ($article['type'] == 'video') {
                                        echo returnIcon('dk-icon-action-facebook-f-' . ($article['shared_status'] == 1 ? 'white' : 'gray'), '', 'index.php?'.  api_get_cidreq().'&action=change_shared_status&id=' . $article['id'], 'Change shared status', 'change-status', array("icons" => "dk-icon-action-facebook-f-white/dk-icon-action-facebook-f-gray"));
                                        echo returnIcon('dk-icon-action-copy-clipboard', '', api_get_path(WEB_PATH). 'main/webtv/shared.php?code=' . shared_url() . ',' . $article['id'], 'Copy clipboard shared link', 'copy-clipboard');                                        
                                    }
                                    echo "\n";
                                    ?>
                                </div>
                                <?php } ?>
                            </article><?php } echo "\n"; ?>
                        </section>