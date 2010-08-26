<? header("Content-type: text/css"); ?>

<? include("../conf/loadconfig.inc.php"); ?>

/**
* eDirectory - Dynamic Style
*
* This style sheet is used to placed classes dependent of PHP constants
* and dynamic values
*
*/

/**
* Featured
*
* @section	dynamic-featured
*/

.featuredListingImage
{ height: <?=IMAGE_FRONT_LISTING_HEIGHT?>px; width: <?=IMAGE_FRONT_LISTING_WIDTH?>px; }

.featuredPromotion
{ width: <?=IMAGE_FRONT_PROMOTION_WIDTH?>px; }

	.featuredPromotionImage
	{ height: <?=IMAGE_FRONT_PROMOTION_HEIGHT?>px; width: <?=IMAGE_FRONT_PROMOTION_WIDTH?>px; }
	
.featuredClassified
{ width: <?=IMAGE_FRONT_CLASSIFIED_WIDTH?>px; }

	.featuredClassifiedImage
	{ height: <?=IMAGE_FRONT_CLASSIFIED_HEIGHT?>px; width: <?=IMAGE_FRONT_CLASSIFIED_WIDTH?>px; }
	
	.mainContent .featuredClassifiedImage
	{ height: <?=IMAGE_FEATURED_CLASSIFIED_HEIGHT?>px; width: <?=IMAGE_FEATURED_CLASSIFIED_WIDTH?>px; }

.featuredEventImage
{ height: <?=IMAGE_FRONT_EVENT_HEIGHT?>px; width: <?=IMAGE_FRONT_EVENT_WIDTH?>px; }

	.mainContent .featuredEventImage
	{ height: <?=IMAGE_FEATURED_EVENT_HEIGHT?>px; width: <?=IMAGE_FEATURED_EVENT_WIDTH?>px; }
	
.featuredArticleImage
{ height: <?=IMAGE_FRONT_ARTICLE_HEIGHT?>px; width: <?=IMAGE_FRONT_ARTICLE_WIDTH?>px; }
	
/**
* Favorites
*
* @section		dynamic-favorites
*/

.favoriteListing
{ width: <?=IMAGE_FAVORITE_LISTING_WIDTH?>px; }

	.favoriteListingImage
	{ height: <?=IMAGE_FAVORITE_LISTING_HEIGHT?>px; width: <?=IMAGE_FAVORITE_LISTING_WIDTH?>px; }

.favoriteEvent
{ width: <?=IMAGE_FAVORITE_EVENT_WIDTH?>px; }

	.favoriteEventImage
	{ height: <?=IMAGE_FAVORITE_EVENT_HEIGHT?>px; width: <?=IMAGE_FAVORITE_EVENT_WIDTH?>px; }

.favoriteClassified
{ width: <?=IMAGE_FAVORITE_CLASSIFIED_WIDTH?>px; }

	.favoriteClassifiedImage
	{ height: <?=IMAGE_FAVORITE_CLASSIFIED_HEIGHT?>px; width: <?=IMAGE_FAVORITE_CLASSIFIED_WIDTH?>px; }

.favoritePromotion
{ width: <?=IMAGE_FAVORITE_PROMOTION_WIDTH?>px; }

	.favoritePromotionImage
	{ height: <?=IMAGE_FAVORITE_PROMOTION_HEIGHT?>px; width: <?=IMAGE_FAVORITE_PROMOTION_WIDTH?>px; }

.favoriteArticle
{ width: <?=IMAGE_FAVORITE_ARTICLE_WIDTH?>px; }

	.favoriteArticleImage
	{ height: <?=IMAGE_FAVORITE_ARTICLE_HEIGHT?>px; width: <?=IMAGE_FAVORITE_ARTICLE_WIDTH?>px; }
