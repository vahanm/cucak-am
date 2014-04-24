<?php
/**
 * Footer
 *
 * @package Cucak.am
 * @subpackage Template
 * @since Cucak.am 1.0
 */
 
 global $isSocial;
?>
                        </div>
                    </div>
        <?php if (!$isSocial) { ?>
                    <div class="adsbar-footer">
                        <script type="text/javascript"><!--
                            google_ad_client = "ca-pub-4388753313853541";
                            /* Footer */
                            google_ad_slot = "9736549118";
                            google_ad_width = 728;
                            google_ad_height = 90;
                        //-->
                        </script>
                        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>
                    </div>
                    
                    <footer id="bottom-footer" role="contentinfo">
                        <div id="footer-links">
                            <?php simplemarket_footerlinks(); ?>
                            
                            <small><?php usage(); ?></small>
                            
                            <div style="float: right; margin-right: 20px;">
                                <?php /*
                                <!-- Circle.Am: DO NOT MODIFY THIS CODE: Start -->
                                <script type="text/javascript">(function() {document.write(unescape("%3Cscript src='http://www.circle.am/service/circlecode.php?sid=5247&amp;bid=241' type='text/javascript'%3E%3C/script%3E"));})();</script>
                                <noscript><div><a href='http://www.circle.am/?w=5247'><img src='http://www.circle.am/service/?sid=5247&amp;bid=241' alt='Circle.Am: Rating and Statistics for Armenian Web Resources' /></a></div></noscript>
                                <!-- Circle.Am: End -->
                                */ ?>
                                <!-- Circle.Am: DO NOT MODIFY THIS CODE: Start -->
                                <script type="text/javascript">(function() {document.write(unescape("%3Cscript src='http://www.circle.am/service/circlecode.php?sid=5247&amp;bid=67' type='text/javascript'%3E%3C/script%3E"));})();</script>
                                <noscript><div><a href='http://www.circle.am/?w=5247'><img src='http://www.circle.am/service/?sid=5247&amp;bid=67' alt='Circle.Am: Rating and Statistics for Armenian Web Resources' /></a></div></noscript>
                                <!-- Circle.Am: End -->
                            </div>
                        </div>
                    </footer>
        <?php } //if (!$isSocial) ?>
                </div>
            </div>
        </div>
        
        <?php if (!$isSocial) { ?>
            <?php wp_footer(); ?>

            <div id="mess" class="abs">N/A</div>
            <div id="pophint" class="abs">N/A</div>
            <div id="toTop">^ <?php _e('Back to Top') ?></div>
        <?php } //if (!$isSocial) ?>
    </body>
</html>
