<?php

    function sitemapgen_makeSitemap($path) {

        if ((MODREWRITE_FEATURE == "on") && (SITEMAP_FEATURE == "on")) {

            $access = false;
            $dbObj = db_getDBObject();
            $sql = "SELECT * FROM Registration WHERE name = 'extra' AND domain = '' AND date_time = '0000-00-00 00:00:00' LIMIT 1";
            $result = $dbObj->query($sql);
            if ($result) {
                if ($row = mysql_fetch_assoc($result)) {
                    if ($row["value"] == strtoupper(md5(VERSION."SITEMAP_FEATUREon"))) {
                        $access = true;
                    }
                }
            }

				
                $files_listinglocation = false;
                $files_listingcategory = false;
                $files_listingdetail = false;
                $files_promotionlocation = false;
                $files_promotioncategory = false;
                $files_eventlocation = false;
                $files_eventcategory = false;
                $files_eventdetail = false;
                $files_classifiedlocation = false;
                $files_classifiedcategory = false;
                $files_classifieddetail = false;
                $files_articlecategory = false;
                $files_articledetail = false;
                $files_content = false;

                if (SITEMAP_HASLISTINGLOCATION == "y") $files_listinglocation = sitemap_createModuleLocations($path, 'listing');
                if (SITEMAP_HASLISTINGCATEGORY == "y") $files_listingcategory = sitemap_createModuleCategories($path, 'listing');
                if (SITEMAP_HASLISTINGDETAIL == "y") $files_listingdetail = sitemap_createModuleDetails($path, 'listing');

                if (SITEMAP_HASPROMOTIONLOCATION == "y") $files_promotionlocation = sitemap_createModuleLocations($path, 'promotion');
                if (SITEMAP_HASPROMOTIONCATEGORY == "y") $files_promotioncategory = sitemap_createModuleCategories($path, 'promotion');

                if (EVENT_FEATURE == 'on') {
                    if (SITEMAP_HASEVENTLOCATION == "y") $files_eventlocation = sitemap_createModuleLocations($path, 'event');
                    if (SITEMAP_HASEVENTCATEGORY == "y") $files_eventcategory = sitemap_createModuleCategories($path, 'event');
                    if (SITEMAP_HASEVENTDETAIL == "y") $files_eventdetail = sitemap_createModuleDetails($path, 'event');
                }

                if (CLASSIFIED_FEATURE == 'on') {
                    if (SITEMAP_HASCLASSIFIEDLOCATION == "y") $files_classifiedlocation = sitemap_createModuleLocations($path, 'classified');
                    if (SITEMAP_HASCLASSIFIEDCATEGORY == "y") $files_classifiedcategory = sitemap_createModuleCategories($path, 'classified');
                    if (SITEMAP_HASCLASSIFIEDDETAIL == "y") $files_classifieddetail = sitemap_createModuleDetails($path, 'classified');
                }

                if (ARTICLE_FEATURE == 'on') {
                    if (SITEMAP_HASARTICLECATEGORY == "y") $files_articlecategory = sitemap_createModuleCategories($path, 'article');
                    if (SITEMAP_HASARTICLEDETAIL == "y") $files_articledetail = sitemap_createModuleDetails($path, 'article');
                }

                if (SITEMAP_HASCONTENT == "y") $files_content = sitemap_createContentMap($path);

                $sitemap_buffer = "";
                $sitemap_buffer .= sitemap_indexPrintHeader();
                if ($files_listinglocation) {
                    foreach ($files_listinglocation as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_listingcategory) {
                    foreach ($files_listingcategory as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_listingdetail) {
                    foreach ($files_listingdetail as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_promotionlocation) {
                    foreach ($files_promotionlocation as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_promotioncategory) {
                    foreach ($files_promotioncategory as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_eventlocation) {
                    foreach ($files_eventlocation as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_eventcategory) {
                    foreach ($files_eventcategory as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_eventdetail) {
                    foreach ($files_eventdetail as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_classifiedlocation) {
                    foreach ($files_classifiedlocation as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_classifiedcategory) {
                    foreach ($files_classifiedcategory as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_classifieddetail) {
                    foreach ($files_classifieddetail as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_articlecategory) {
                    foreach ($files_articlecategory as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_articledetail) {
                    foreach ($files_articledetail as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                if ($files_content) {
                    foreach ($files_content as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                $sitemap_buffer .= sitemap_indexPrintFooter();
                if (!sitemap_writeFile($path.'/custom/sitemap/index.xml', $sitemap_buffer)) die('ERROR WHILE SAVING THE '.$path.'/custom/sitemap/index.xml!'.PHP_EOL);

            } else {

                if (file_exists($path.'/custom/sitemap/index.xml')) {
                    @unlink($path.'/custom/sitemap/index.xml');
                }

            }

        } else {

            if (file_exists($path.'/custom/sitemap/index.xml')) {
                @unlink($path.'/custom/sitemap/index.xml');
            }

        }

    }

    function sitemapgen_makeSitemapNews($path) {

        if ((MODREWRITE_FEATURE == "on") && (SITEMAP_FEATURE == "on")) {

            $access = false;
            $dbObj = db_getDBObject();
            $sql = "SELECT * FROM Registration WHERE name = 'extra' AND domain = '' AND date_time = '0000-00-00 00:00:00' LIMIT 1";
            $result = $dbObj->query($sql);
            if ($result) {
                if ($row = mysql_fetch_assoc($result)) {
                    if ($row["value"] == strtoupper(md5(VERSION."SITEMAP_FEATUREon"))) {
                        $access = true;
                    }
                }
            }

            if ($access) {

                $files_articlenews = false;

                if (ARTICLE_FEATURE == 'on') {
                    if (SITEMAP_HASARTICLENEWS == "y") $files_articlenews = sitemap_createModuleNews($path, 'article');
                }

                $sitemap_buffer = "";
                $sitemap_buffer .= sitemap_indexPrintHeader();
                if ($files_articlenews) {
                    foreach ($files_articlenews as $file) {
                        $sitemap_buffer .= sitemap_indexPrintNodeSitemap($file);
                    }
                }
                $sitemap_buffer .= sitemap_indexPrintFooter();
                if (!sitemap_writeFile($path.'/custom/sitemap/indexnews.xml', $sitemap_buffer)) die('Erro ao salvar '.$path.'/custom/sitemap/indexnews.xml!'.PHP_EOL);

            } else {

                if (file_exists($path.'/custom/sitemap/indexnews.xml')) {
                    @unlink($path.'/custom/sitemap/indexnews.xml');
                }

            }

        } else {

            if (file_exists($path.'/custom/sitemap/indexnews.xml')) {
                @unlink($path.'/custom/sitemap/indexnews.xml');
            }

        }

    }

?> 