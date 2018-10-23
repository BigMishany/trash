<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "воздушные шары, воздушные шарики, украшения для праздника, украшения для выпускного, праздничная продукция");
$APPLICATION->SetPageProperty("description", "Интернет-магазин \"Шарстар\" - это выгодные цены на воздушные шары и праздничную продукцию оптом и в розницу");
$APPLICATION->SetPageProperty("title", "Интернет-магазин воздушных шаров и карнавальной продукции");
$APPLICATION->SetTitle("Интернет-магазин воздушных шаров и карнавальной продукции");
global $inCity;

use Bitrix\Main\Diag;

$connection = Bitrix\Main\Application::getConnection();

$tracker = $connection->startTracker();
$ID=68811;

$ar_res = CCatalogProduct::GetByID($ID);
if($ar_res!==null) {
    echo "<br>Товар с кодом " . $ID . ":OK!<pre>";


    $storeRes = CCatalogStoreProduct::GetList(
        array("SORT" => "ASC"), # сортировка
        array("PRODUCT_ID" => $ID), # отбор по фильтру
        false, # группировка по полям
        false, # параметры выборки
        array("*") # поля для выборки
    );
    while ($arStoreParam = $storeRes->Fetch()) {
        $q = $arStoreParam['AMOUNT'];
    }
    if($q!=$ar_res['QUANTITY'])
    CCatalogProduct::Update($ID, array('QUANTITY' => $q));


}
$connection->stopTracker();
var_dump($tracker->getCounter());

/*
 * костыль для синхронизации с битриксом
 */
/*
$connection = Bitrix\Main\Application::getConnection();
$sqlHelper = $connection->getSqlHelper();
$sql = "INSERT INTO state_table (id_product) VALUES (1);";
$recordset = $connection->queryExecute($sql);
*/
?>