<?php
/**
 * Search form modal
 */
?>
<div id="nsix-search-modal" class="modal">
  <div class="modal-dialog md:w-[35rem]">
    <div class="dark:divide-charcoal-800/40 bg-charcoal-100 dark:bg-charcoal-700 h-[30rem] divide-y rounded-t-lg p-0 shadow-lg outline-0 sm:h-auto sm:rounded-lg">
      <form action="<?php echo esc_url( '/' ); ?>" method="get" class="searchform text-charcoal-800 dark:text-charcoal-100 flex h-10 items-center justify-start space-x-2 px-4 py-6">
        <svg class="dark:fill-charcoal-100 mt-1 block h-5 fill-black" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30">
          <path d="M13 3C7.4889971 3 3 7.4889971 3 13c0 5.511003 4.4889971 10 10 10C15.396508 23 17.597385 22.148986 19.322266 20.736328l5.970703 5.970703a1.0001 1.0001.0 101.414062-1.414062l-5.970703-5.970703C22.148986 17.597385 23 15.396508 23 13 23 7.4889971 18.511003 3 13 3zm0 2c4.430123.0 8 3.5698774 8 8 0 4.430123-3.569877 8-8 8-4.4301226.0-8-3.569877-8-8 0-4.4301226 3.5698774-8 8-8z"></path>
        </svg>
        <input type="text" name="s" placeholder="Search..."  class="search-field bg-charcoal-100 dark:bg-charcoal-700 placeholder-charcoal-700/20 h-10 w-full px-2 outline-none"/>
        
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 hidden cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:flex">ESC</button>
        
        <button type="button" class="closemodal dark:bg-charcoal-800 dark:border-charcoal-800 cursor-pointer rounded border bg-gray-100 px-2 text-[14px] active:scale-95 sm:hidden">
          <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="24" viewBox="0 0 24 24">
            <path d="M 4.9902344 3.9902344 A 1.0001 1.0001 0 0 0 4.2929688 5.7070312 L 10.585938 12 L 4.2929688 18.292969 A 1.0001 1.0001 0 1 0 5.7070312 19.707031 L 12 13.414062 L 18.292969 19.707031 A 1.0001 1.0001 0 1 0 19.707031 18.292969 L 13.414062 12 L 19.707031 5.7070312 A 1.0001 1.0001 0 0 0 18.980469 3.9902344 A 1.0001 1.0001 0 0 0 18.292969 4.2929688 L 12 10.585938 L 5.7070312 4.2929688 A 1.0001 1.0001 0 0 0 4.9902344 3.9902344 z"></path>
          </svg>
        </button>

      </form>
      <div class="py-3 px-4">
        <h3 class="text-charcoal-800 dark:text-charcoal-100 font-semibold"><?php echo esc_html__( 'Result', 'narasix' ); ?></h3>
      </div>
      <div class="relative overflow-auto">
        <div class="relative p-4 mx-auto h-[23rem] md:h-[20rem] md:mb-3 overflow-auto">
          <ul id="search-results" class="space-y-2 overflow-auto"></ul>
        </div>
      </div>
    </div>
  </div>
</div>