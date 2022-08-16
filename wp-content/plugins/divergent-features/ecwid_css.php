<?php 
add_action('wp_head','divergent_ecwid_css', 99);

function divergentecwidcompress($buffer) {
    /* remove comments */
    $buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
    /* remove tabs, spaces, newlines, etc. */
    $buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
    return $buffer;
}

function divergent_ecwid_css(){
    if (! is_front_page()) { 
    $divergentfirstcolor = get_theme_mod('divergent_first_color');    
    $divergentsecondcolor = get_theme_mod('divergent_second_color');
    $divergentthirdcolor = get_theme_mod('divergent_third_color');
    $divergentfourthcolor = get_theme_mod('divergent_fourth_color');
    $divergentfifthcolor = get_theme_mod('divergent_fifth_color');
    $divergenth3size = get_theme_mod('divergent_h3');
    $divergenth4size = get_theme_mod('divergent_h4');
    $divergenth6size = get_theme_mod('divergent_h6');
    $divergentpsize = get_theme_mod('divergent_p');
    
    ob_start("divergentecwidcompress");
?>
<style type="text/css">
/* ================= CUSTOM ECWID CSS ================== */  

.ecwid-productBrowser-auth-mini a,.ecwid-productBrowser-auth-mini span,.ecwid-btn,.ecwid-AddressForm-fields-topPanel .ecwid-btn .gwt-HTML,.ecwid-Checkout-BreadCrumbs-link,.ecwid-OrdersList-OrderBox-status,.ecwid-OrdersList-OrderBox-totals-shippingRow,.ecwid-OrdersList-OrderBox-totals-total,.ecwid-DateRangeBox-range,.ecwid-results-topPanel-viewAsPanel div,.ecwid-results-topPanel-sortByPanel .gwt-Label,.ecwid-results-topPanel-sortByPanel select, .ecwid-productBrowser-productsTable-sku .ecwid-productBrowser-sku, .pswp__caption__center small,.ecwid-productBrowser-relatedProducts-item .ecwid-productBrowser-sku,.ecwid-categories-vertical-table-cell-categoryLink a span,.ecwid-productBrowser-categoryPath,.ecwid-productBrowser-categoryPath a 
{
	font-size: <?php if (!empty($divergentpsize)) { echo $divergentpsize; } else { echo esc_attr("16"); } ?>px !important
}
.ecwid-productBrowser-price-value 
{
	font-size: <?php if (!empty($divergenth3size)) { echo $divergenth3size; } else { echo esc_attr("30"); } ?>px !important
}
.ecwid-productBrowser-head,.ecwid-productBrowser-relatedProducts-title,.ecwid-productBrowser-productsList-details .ecwid-productBrowser-productNameLink a,.ecwid-productBrowser-productsTable-row .ecwid-productBrowser-price-value,.ecwid-productBrowser-relatedProducts-item .ecwid-productBrowser-price 
{
	font-size: <?php if (!empty($divergenth4size)) { echo $divergenth4size; } else { echo esc_attr("26"); } ?>px !important
}
	 .ecwid-shopping-cart-categories .horizontal-menu ul li a span,.ecwid-productBrowser-subcategories-categoryName span.gwt-InlineLabel,.ecwid-categories-category,.ecwid-productBrowser-productNameLink a,.ecwid-productBrowser-relatedProducts-item .ecwid-productBrowser-productNameLink,.ecwid-Invoice-blockTitle,.ecwid-Invoice-Summary-label-price,.ecwid-Invoice-Summary-value-price,.ecwid-btn--placeOrder,.ecwid-productBrowser-cart-totalLabel,.ecwid-productBrowser-cart-totalAmount,.ecwid-productBrowser-search-noResultsLabel,.pswp__caption__center,.ecwid-pager,.page-block-left .ecwid-categories-vertical a span 
{
	font-size: <?php if (!empty($divergenth6size)) { echo $divergenth6size; } else { echo esc_attr("18"); } ?>px !important
}
.ecwid-SearchPanel-field:focus,.ecwid-form input:focus,.ecwid-productBrowser-details-qtyTextField:focus,.ecwid-Orders-SearchPanel input:focus,.ecwid-DateRangePopup input:focus,input.ecwid-productBrowser-cart-qtyTextField:focus,.ecwid-Invoice-Summary-label-price,.ecwid-Invoice-Summary-value-price,.ecwid-Invoice-footer-placeOrder-text .gwt-Label,.ecwid-productBrowser-price-value, .ecwid-productBrowser-price-list,.ecwid-productBrowser-details-rightPanel .ecwid-productBrowser-price,.ecwid-productBrowser-relatedProducts-title,.ecwid-productBrowser-relatedProducts-item .ecwid-productBrowser-price,.ecwid-productBrowser-relatedProducts-item .ecwid-productBrowser-productNameLink 
{
	color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?> !important;
}
.ecwid-SearchPanel-field,.ecwid-form input,.ecwid-productBrowser-details-qtyTextField,.ecwid-Orders-SearchPanel input,.ecwid-DateRangePopup input,input.ecwid-productBrowser-cart-qtyTextField,.gwt-InlineLabel,.horizontal-menu-parent a span,.horizontal-menu-parent svg,.horizontal-menu-parent a,.ecwid-productBrowser-productNameLink a, .gwt-HTML, .ecwid-Checkout-blockTitle, .ecwid-Invoice-blockTitle, .ecwid-OrdersList-OrderBox-cell,.ecwid-OrdersList-OrderBox-product div a,.ecwid-OrdersList-OrderBox-sku, .ecwid-categories-vertical-table-cell-categoryLink a span,.pswp__caption__center small 
{
	color: <?php if (!empty($divergentsecondcolor)) { echo $divergentsecondcolor; } else { echo '#949494'; } ?> !important;
}
.ecwid-SearchPanel-button,button.ecwid-btn,.ecwid-SearchPanel-button:hover,button.ecwid-btn:hover,div.ecwid-minicart-mini-rollover span, div.ecwid-minicart-mini-rollover a,.ecwid-productBrowser-auth,.ecwid-minicart-mini a,.ecwid-minicart-mini span,.horizontal-menu-subParent a:hover,.horizontal-menu-subParent a:hover span,.ecwid-productBrowser-head, div.ecwid-Invoice-cell-title 
{
	color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-productBrowser-subcategories-categoryName span.gwt-InlineLabel:hover,.horizontal-menu-parent a span:hover,.ecwid-productBrowser-productNameLink a:hover,.ecwid-AddressBook-addButton,.ecwid-OrdersList-OrderBox-price,table.ecwid-OrdersList-OrderBox-cell,.ecwid-OrdersList-OrderBox-totals-price,.ecwid-OrdersList-OrderBox-header span,.horizontal-menu-parent a span:hover,.horizontal-menu-parent a:hover,.horizontal-menu-parent a:hover span,.ecwid-productBrowser-relatedProducts-item:hover .ecwid-productBrowser-productNameLink 
{
	color: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
}
.ecwid-SearchPanel-button,button.ecwid-btn,.ecwid-minicart-mini,.ecwid-productBrowser-head,.datePickerDayIsToday,div.ecwid-Invoice-cell-title 
{
	background: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?> !important;
}
.ecwid-SearchPanel-button:hover,button.ecwid-btn:hover,div.ecwid-minicart-mini-rollover,.datePickerDay:hover 
{
	background: <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
}
.ecwid-shopping-cart-categories .horizontal-menu,.ecwid-OrdersList-OrderBox-header,td.ecwid-OrdersList-OrderBox-cellEven,td.ecwid-OrdersList-OrderBox-cellOdd,.ecwid-OrdersList-OrderBox-footer,.ecwid-productBrowser-productsGrid-cellMiddle.ecwid-productBrowser-productsGrid-productInside,.ecwid-productBrowser-productsGrid-productBottomFragment,.ecwid-productBrowser-auth-mini,.ecwid-productBrowser-subcategories-categoryName,.ecwid-productBrowser-backgroundedPanel,div.ecwid-overlay,.horizontal-menu-subParent,.horizontal-menu-parent a,.ecwid-Checkout-ShippingAddress-top,.ecwid-AddressForm-fields-topPanel .ecwid-btn,.ecwid-Orders-EmptyList,.ecwid-AddressBook-block,td.ecwid-Invoice-cell,td.ecwid-Invoice-edgeCell,.ecwid-productBrowser-productsList-productRow,.ecwid-productBrowser-productsTable-cell,.ecwid-productBrowser-categoryPath,.pswp__caption,.ecwid-productBrowser-relatedProducts-item-bottom 
{
	background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?> !important;
}   
.ecwid-DateRangePopup,.dateBoxPopup,.ecwid-minicart-floating 
{
	background: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-SearchPanel-field:focus,.ecwid-form input:focus,.ecwid-productBrowser-details-qtyTextField:focus,.ecwid-productBrowser-search-SearchPanel input[type="search"]:focus,.ecwid-Orders-SearchPanel input:focus,.ecwid-DateRangePopup input:focus,input.ecwid-productBrowser-cart-qtyTextField:focus 
{
	border: 1px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
}
.ecwid-minicart-mini 
{
	border-left:3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-productBrowser-cart-totalAmountPanel,.ecwid-OrdersList-OrderBox-footer 
{
	border-top:1px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
td.ecwid-Invoice-edgeCell 
{
	border-top:3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-Invoice-itemsTable-headerCell,.ecwid-Invoice-itemsTable-cell,.ecwid-productBrowser-productsTable-cell 
{
	border-color: <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-OrdersList-OrderBox-header 
{
	border-bottom:1px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.ecwid-productBrowser-productsList-productRow td 
{
	border-bottom:20px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
.page-block-left .ecwid-categories-vertical td {
    border-color: <?php if (!empty($secondcolor)) { echo $secondcolor; } else { echo '#262626'; } ?> !important;
}  
.page-block-left .ecwid-SearchPanel-button {
    background: <?php if (!empty($secondcolor)) { echo $secondcolor; } else { echo '#262626'; } ?> !important;
}
@media only screen and (max-width: 680px) 
{
.ecwid-categoriesTabBar 
{
	background: <?php if (!empty($divergentthirdcolor)) { echo $divergentthirdcolor; } else { echo '#f3f3f3'; } ?> !important;
}
.ecwid-Invoice-header-placeOrder 
{
	border-bottom: 3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}
	td.ecwid-Invoice-header-placeOrder-text .gwt-Label 
{
	color: <?php if (!empty($divergentfirstcolor)) { echo $divergentfirstcolor; } else { echo '#222222'; } ?> !important;
}
.ecwid-Invoice-PaymentDetails 
{
	border-bottom: 3px solid <?php if (!empty($divergentfifthcolor)) { echo $divergentfifthcolor; } else { echo '#ffffff'; } ?> !important;
}

}
@media only screen and (max-width: 560px) 
{
.ecwid-minicart-mini 
{
	border:none !important
}

}
@media only screen and (max-width: 480px) 
{
.ecwid-productBrowser-head 
{
	border-top:1px solid <?php if (!empty($divergentfourthcolor)) { echo $divergentfourthcolor; } else { echo '#de3926'; } ?> !important;
}
.horizontal-menu-parent a 
{
	background-color:transparent !important
}
}
</style>
<?php ob_end_flush(); ?>
<?php } ?>
<?php } ?>