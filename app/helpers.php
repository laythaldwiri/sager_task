<?php

use App\Models\ProductReview;
use App\Models\StoreReview;
// =====================================================================================
// =========================== Real Store Review Value Section ===========================
// =====================================================================================
function singleRealStoreReview($store_id)
{
    $singleStoreReviews = StoreReview::where(['store_id' => $store_id])->get();
    if ($singleStoreReviews->count() > 0) {
        $r_1 = $r_2 = $r_3 = $r_4 = $r_5 = $total_reviews = 0;
        foreach ($singleStoreReviews as $singleStoreReview) {
            $total_reviews += 1;
            if ($singleStoreReview->review_value == 1) {
                $r_1 += 1;
            } elseif ($singleStoreReview->review_value == 2) {
                $r_2 += 1;
            } elseif ($singleStoreReview->review_value == 3) {
                $r_3 += 1;
            } elseif ($singleStoreReview->review_value == 4) {
                $r_4 += 1;
            } elseif ($singleStoreReview->review_value == 5) {
                $r_5 += 1;
            } else {
                continue;
            }
        }
        $result = (($r_1 * 1) + ($r_2 * 2) + ($r_3 * 3) + ($r_4 * 4) + ($r_5 * 5)) / $total_reviews;
        return $result;
    } else {
        return 0;
    }
}
// =====================================================================================
// ========================== Store Review Stars Number Section ==========================
// =====================================================================================
function singleStoreReviewStarsNumber($real_store_review)
{
    if ($real_store_review > 0 && $real_store_review <= 0.5) {
        return $result = 0.5;
    } elseif ($real_store_review > 0.5 && $real_store_review <= 1) {
        return $result = 1;
    } elseif ($real_store_review > 1 && $real_store_review <= 1.5) {
        return $result = 1.5;
    } elseif ($real_store_review > 1.5 && $real_store_review <= 2) {
        return $result = 2;
    } elseif ($real_store_review > 2 && $real_store_review <= 2.5) {
        return $result = 2.5;
    } elseif ($real_store_review > 2.5 && $real_store_review <= 3) {
        return $result = 3;
    } elseif ($real_store_review > 3 && $real_store_review <= 3.5) {
        return $result = 3.5;
    } elseif ($real_store_review > 3.5 && $real_store_review <= 4) {
        return $result = 4;
    } elseif ($real_store_review > 4 && $real_store_review <= 4.5) {
        return $result = 4.5;
    } elseif ($real_store_review > 4.5 && $real_store_review <= 5) {
        return $result = 5;
    } else {
        return 0;
    }
}
// =====================================================================================
// ===================== Store Reviews Percentage Details Section ========================
// =====================================================================================
function storeReviewPercentageDetails($store_id, $r)
{
    $storeReviews = StoreReview::where(['store_id' => $store_id])->get();
    if ($storeReviews->count() > 0) {
        $r_1 = $r_2 = $r_3 = $r_4 = $r_5 = $total_reviews = 0;
        foreach ($storeReviews as $storReview) {
            $total_reviews += 1;
            if ($storReview->review_value == 1) {
                $r_1 += 1;
            } elseif ($storReview->review_value == 2) {
                $r_2 += 1;
            } elseif ($storReview->review_value == 3) {
                $r_3 += 1;
            } elseif ($storReview->review_value == 4) {
                $r_4 += 1;
            } elseif ($storReview->review_value == 5) {
                $r_5 += 1;
            } else {
                continue;
            }
        }

        if ($r == 1) {
            return $percentage_result = $r_1 * 100 / $total_reviews;
        } elseif ($r == 2) {
            return $percentage_result = $r_2 * 100 / $total_reviews;
        } elseif ($r == 3) {
            return $percentage_result = $r_3 * 100 / $total_reviews;
        } elseif ($r == 4) {
            return $percentage_result = $r_4 * 100 / $total_reviews;
        } elseif ($r == 5) {
            return $percentage_result = $r_5 * 100 / $total_reviews;
        } else {
            return $percentage_result = 'غير معرف';
        }
    } else {
        return 0;
    }
}




















// =====================================================================================
// =========================== Real Product Review Value Section ===========================
// =====================================================================================
function singleRealProductReview($product_id)
{
    $singleProductReviews = ProductReview::where(['product_id' => $product_id])->get();
    if ($singleProductReviews->count() > 0) {
        $r_1 = $r_2 = $r_3 = $r_4 = $r_5 = $total_reviews = 0;
        foreach ($singleProductReviews as $singleProductReview) {
            $total_reviews += 1;
            if ($singleProductReview->review_value == 1) {
                $r_1 += 1;
            } elseif ($singleProductReview->review_value == 2) {
                $r_2 += 1;
            } elseif ($singleProductReview->review_value == 3) {
                $r_3 += 1;
            } elseif ($singleProductReview->review_value == 4) {
                $r_4 += 1;
            } elseif ($singleProductReview->review_value == 5) {
                $r_5 += 1;
            } else {
                continue;
            }
        }
        $result = (($r_1 * 1) + ($r_2 * 2) + ($r_3 * 3) + ($r_4 * 4) + ($r_5 * 5)) / $total_reviews;
        return $result;
    } else {
        return 0;
    }
}
// =====================================================================================
// ========================== Product Review Stars Number Section ==========================
// =====================================================================================
function singleProductReviewStarsNumber($real_product_review)
{
    if ($real_product_review > 0 && $real_product_review <= 0.5) {
        return $result = 0.5;
    } elseif ($real_product_review > 0.5 && $real_product_review <= 1) {
        return $result = 1;
    } elseif ($real_product_review > 1 && $real_product_review <= 1.5) {
        return $result = 1.5;
    } elseif ($real_product_review > 1.5 && $real_product_review <= 2) {
        return $result = 2;
    } elseif ($real_product_review > 2 && $real_product_review <= 2.5) {
        return $result = 2.5;
    } elseif ($real_product_review > 2.5 && $real_product_review <= 3) {
        return $result = 3;
    } elseif ($real_product_review > 3 && $real_product_review <= 3.5) {
        return $result = 3.5;
    } elseif ($real_product_review > 3.5 && $real_product_review <= 4) {
        return $result = 4;
    } elseif ($real_product_review > 4 && $real_product_review <= 4.5) {
        return $result = 4.5;
    } elseif ($real_product_review > 4.5 && $real_product_review <= 5) {
        return $result = 5;
    } else {
        return 0;
    }
}
// =====================================================================================
// ===================== Product Reviews Percentage Details Section ========================
// =====================================================================================
function productReviewPercentageDetails($product_id, $r)
{
    $productReviews = ProductReview::where(['product_id' => $product_id])->get();
    if ($productReviews->count() > 0) {
        $r_1 = $r_2 = $r_3 = $r_4 = $r_5 = $total_reviews = 0;
        foreach ($productReviews as $storReview) {
            $total_reviews += 1;
            if ($storReview->review_value == 1) {
                $r_1 += 1;
            } elseif ($storReview->review_value == 2) {
                $r_2 += 1;
            } elseif ($storReview->review_value == 3) {
                $r_3 += 1;
            } elseif ($storReview->review_value == 4) {
                $r_4 += 1;
            } elseif ($storReview->review_value == 5) {
                $r_5 += 1;
            } else {
                continue;
            }
        }

        if ($r == 1) {
            return $percentage_result = $r_1 * 100 / $total_reviews;
        } elseif ($r == 2) {
            return $percentage_result = $r_2 * 100 / $total_reviews;
        } elseif ($r == 3) {
            return $percentage_result = $r_3 * 100 / $total_reviews;
        } elseif ($r == 4) {
            return $percentage_result = $r_4 * 100 / $total_reviews;
        } elseif ($r == 5) {
            return $percentage_result = $r_5 * 100 / $total_reviews;
        } else {
            return $percentage_result = 'غير معرف';
        }
    } else {
        return 0;
    }
}
