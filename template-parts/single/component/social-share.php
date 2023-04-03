<div class="modal" id="sharemodal" aria-hidden="true">
  <div class="modal-dialog md:w-[30rem]">
    <div class="dark:divide-charcoal-800/40 bg-charcoal-100 dark:bg-charcoal-700 h-[11rem] divide-y rounded-t-lg p-0 shadow-lg outline-0 sm:h-auto sm:rounded-lg">
      <div class="text-charcoal-800 dark:text-charcoal-100 flex h-10 items-center justify-start space-x-2 px-4 py-6">
        <input type="text" id="permalink" value="<?php the_permalink(); ?>" class="search-field bg-charcoal-100 dark:bg-charcoal-700 placeholder-charcoal-700/20 h-10 w-full px-2 outline-none"/>
        <button id="copy-button"><?php echo narasix_svg_icon( array( 'icon' => 'copy', 'class' => 'icons-md' ) ) ;?></button>
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 hidden cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:flex">ESC</button>
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="24" viewBox="0 0 24 24">
            <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
          </svg>
        </button>
      </div>

      <div class="py-3 px-4">
        <h3 class="mb-3 text-charcoal-800 dark:text-charcoal-100"><?php echo esc_html__( 'Share', 'narasix' ) ?></h3>
  
        <div id="nx_share">
          <button class="scroll-left bg-charcoal-200 dark:bg-charcoal-700 h-8 w-8 m-auto absolute rounded-full shadow flex justify-center items-center cursor-pointer">
            <?php echo narasix_svg_icon( array( 'icon' => 'chevron-left', 'class' => 'icons-md' ) ) ;?>
          </button>

          <ul class="nx-carrousel-flexbox space-x-4">
            <?php
              Narasix_Core::post_social_share( [
                'url' => get_permalink(),
                'title' => get_the_title(),
                'image' => get_the_post_thumbnail( 'narasix_sm' ),
                'desc' => get_the_excerpt(),
              ] );
            ?>
          </ul>

          <button class="scroll-right bg-charcoal-200 dark:bg-charcoal-700 h-8 w-8 m-auto absolute rounded-full shadow flex justify-center items-center cursor-pointer">
            <?php echo narasix_svg_icon( array( 'icon' => 'chevron-right', 'class' => 'icons-md' ) ) ;?>
          </button>

        </div>
      </div>

    </div>
  </div>
</div>

<?php
	function js_share_init() {
    if( is_single() ) {?>
			<script>
        var isAnimating = false;

          function scrollLeftAnimate(elem, unit) {

              if (!elem || isAnimating) {
                  //if element not found / if animating, do not execute slide
                  return;
              }

              var time = 300; // animation duration in MS, the smaller the faster.
              var from = elem.scrollLeft; // to continue the frame posistion
              var aframe =
                  10; //fraction of frame frequency , set 1 for smoothest  ~ set 10++ for lower FPS (reduce CPU usage)
              isAnimating = true; //if animating prevent double trigger animation

              var start = new Date().getTime(),
                  timer = setInterval(function () {
                      var step = Math.min(2, (new Date().getTime() - start) / time);
                      elem.scrollLeft = ((step * unit) + from);
                      if (step === 2) {
                          clearInterval(timer);
                          isAnimating = false;
                      }
                  }, aframe);
          }



          function initDealCarrousel(dealCarrouselID) {
              var target = document.querySelector("#" + dealCarrouselID + " .nx-carrousel-flexbox");
              var cardOutterWidth;
              var maxCarrouselScroll;

          function updateUpaCarrouselInfo() {
              cardOutterWidth = document.querySelector("#" + dealCarrouselID + " .share-to").offsetWidth; //you can define how far the scroll
              maxCarrouselScroll = (document.querySelectorAll("#" + dealCarrouselID + " .share-to").length *
                      cardOutterWidth) - document.querySelector("#" + dealCarrouselID + " .nx-carrousel-flexbox")
                  .clientWidth;
          }

          document.querySelector("#" + dealCarrouselID + " .scroll-left").addEventListener("click",
              function () {
                  updateUpaCarrouselInfo(); //in case window resized, will get new info
                  if (target.scrollLeft > 0) {
                      scrollLeftAnimate(target, -cardOutterWidth * 2);
                  }
              }
          );

          document.querySelector("#" + dealCarrouselID + " .scroll-right").addEventListener("click",
              function () {
                  updateUpaCarrouselInfo(); //in case window resized, will get new info 
                  if (target.scrollLeft < maxCarrouselScroll) {
                      scrollLeftAnimate(target, cardOutterWidth * 2);
                  }
              }
          );
        }
        // Initiate the container with ID
        initDealCarrousel('nx_share'); //carrousel ID

        document.getElementById("copy-button").addEventListener("click", function() {
          var permalink = document.getElementById("permalink");
          permalink.select();
          document.execCommand("copy");
        });
			</script>
			<?php
    }
  }
add_action('wp_footer', 'js_share_init');
?>