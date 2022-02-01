-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Хост: almtrade.mysql.ukraine.com.ua
-- Время создания: Янв 30 2022 г., 13:10
-- Версия сервера: 5.7.33-36-log
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `almtrade_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `aboutus`
--

CREATE TABLE `aboutus` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `text_en` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `aboutus`
--

INSERT INTO `aboutus` (`id`, `text`, `text_en`) VALUES
(1, 'Станимэкс это 18 лет работы на рынке Украины в области бывшего в эксплуатации металлорежущего оборудования и КПО.', 'We are your partner in supply of used machine tools from Europe'),
(2, 'Наша фирма специализируется в основном на купле-продаже  бывшего в эксплуатации м/о оборудования, такого как: токарные, фрезерные, расточные, круглошлифовальные, зубообрабатывающие и другие станки, а также механическими и гидравлическими прессами.', 'The ALM Trade Sro is Slovakian trading company with export-import activity in sphere of used metal-working machines and forging equipment. We are specialising in selling and buying of used metal-working machine tools, mostly of European origin. Our wide range of products includes HDL, CNC turning lathe, HBM, VTL, grinding, gear hobbing, mechanical, hydraulic presses. \r\n&lt;p&gt;\r\nWe also offer for sale used forging machines from Russia &amp; other countries\r\n&lt;/p&gt;'),
(3, 'В условиях формирования рыночных структур, основанных на свободном бизнесе, фирма СТАНИМЭКС предлагает покупателям хорошо организованную систему поиска, покупки и поставки металлообрабатывающего оборудования в соответствии с мировыми стандартами.', ''),
(4, '', ''),
(5, 'ООО \"Станимэкс\"<br />\r\nТел./Факс: +380-57-7315228<br />\r\nадрес: 61003-Харьков, Украина<br/>\r\nпр.Московский, 19/23, офис 40', '');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts_en`
--

CREATE TABLE `contacts_en` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` tinytext NOT NULL,
  `descr` text NOT NULL,
  `img` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contacts_en`
--

INSERT INTO `contacts_en` (`id`, `name`, `descr`, `img`) VALUES
(1, 'Address', 'Head office: Spitalska 53, 81101, Bratislava, Slovakia', 'Addres'),
(2, 'Mobile:', '+ 421 940211917 (WhatsApp)\r\n&lt;br&gt;\r\n+ 49 17627201813(WhatsApp)\r\n&lt;br&gt;\r\n+ 372 59399716 (Whatsapp)', 'Phone'),
(3, 'E-mail', 'almtradesro@gmail.com\r\n&lt;br&gt;\r\ninfo.almtrade@gmail.com', 'Email'),
(4, 'German Branch', 'almtrade@t-online.de\r\n&lt;br&gt;\r\nalmtrade@web.de\r\n&lt;br&gt;\r\n+ 49 17627201813(WhatsApp)', 'Addres');

-- --------------------------------------------------------

--
-- Структура таблицы `home`
--

CREATE TABLE `home` (
  `id` int(10) UNSIGNED NOT NULL,
  `logotext` text NOT NULL,
  `maintext` text NOT NULL,
  `offtext` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `home`
--

INSERT INTO `home` (`id`, `logotext`, `maintext`, `offtext`) VALUES
(1, '   Machine Tools &amp; Accessories', 'We are keeping our business in running in any situation and make shipments in the present time as well.', '\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `img_name` varchar(255) NOT NULL,
  `pos_id` smallint(5) UNSIGNED NOT NULL,
  `main` tinyint(1) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `img_name`, `pos_id`, `main`) VALUES
(113, 'aboutus1550149752.jpg', 0, NULL),
(140, 'szkw-400_5_M3fhYo.jpg', 28, 0),
(141, 'szkw-400_10_Enme5U.jpg', 28, 1),
(142, 'szkw-400_11_FpAg8W.jpg', 28, 0),
(143, 'szkw-400_14_EYO7vM.jpg', 28, 0),
(144, 'szkw-400_77_Zbjdr.jpg', 28, 0),
(145, 'szkw-400_16_ERtBL3.jpg', 28, 0),
(208, 'zskw-400_2wb_LQEidK.jpg', 28, 0),
(209, 'zskw-400_9wb_Vs68QL.jpg', 28, 0),
(216, 'fcv50nc_2wb_WKSggF.jpg', 40, 0),
(217, 'fcv50nc_6wb_chZq8T.jpg', 40, 0),
(218, 'fcv50nc_9bw_xI5FHF.jpg', 40, 0),
(219, 'fcv50nc_8wb_l30k8C.jpg', 40, 0),
(236, 'erfurtpknt-160_wbx_XOAxqP.jpg', 41, 0),
(238, 'pkz800_7wbx_wlHjVt.jpg', 46, 1),
(239, 'pkz800_12wbx_N1GYuG.jpg', 46, 0),
(240, 'pkz800_titul3_icAphS.jpg', 46, 0),
(241, 'pkz800_3wbx_amrn5d.jpg', 46, 0),
(249, 'tosoh-6_3wb_KdTmsE.jpg', 48, 0),
(298, 'pknt-160_4wb_Ghs02k.jpg', 41, 0),
(299, 'pknt160_20wb_zYHS1j.jpg', 41, 0),
(300, 'pknt160_lbl2wb_FR8Txt.jpg', 41, 0),
(328, '1h983_1wbx_aDI1GH.jpg', 65, 1),
(329, 'sr18_2wbx_pgCXC.jpg', 66, 0),
(330, 'sr18_1_RdRH6o.jpg', 66, 1),
(331, 'sr18_5wbx_Y69PhI.jpg', 66, 0),
(332, 'sn501_3wbx_qlTTDS.jpg', 67, 1),
(333, 'sn501_1_qvrLK.jpg', 67, 0),
(334, 'sn501_7_3OCVMH.jpg', 67, 0),
(335, 'sn501_6_RL9VEm.jpg', 67, 0),
(337, 'tos_oh6_5wbx_CwEj9o.jpg', 48, 0),
(338, 'tos_oh6_oho50_1_vaVifN.jpg', 48, 0),
(339, 'tosoh6_17_AjYwfP.jpg', 48, 0),
(340, 'tosoh6_20_8rDXMp.jpg', 48, 0),
(341, 'tosoh6_21_vLJ1wx.jpg', 48, 0),
(342, 'tosoh6_25wbx_qI5k1E.jpg', 48, 0),
(343, 'tosoh6_23_pkJrCY.jpg', 48, 0),
(344, 'tosoh6_22_vhufr4.jpg', 48, 0),
(345, 'tos_oh6_16wb_CZTSvz.jpg', 48, 1),
(346, 'tos_oh6_32_etdwQ7.jpg', 48, 0),
(347, 'tosoh6_15_CY7dGb.jpg', 48, 0),
(351, 'modulzfwz500x8_16wb_59PR3E.jpg', 68, 0),
(355, 'modulzfwz500x8_19wb_O50zWX.jpg', 68, 0),
(357, 'modulzfwz500x8_21wb_10u8p.jpg', 68, 0),
(359, 'modulzfwz500x8_14access_wb_siI3AX.jpg', 68, 0),
(360, 'modulzfwz500x8_23wb_yMtNTH.jpg', 68, 0),
(372, 'img_zfwz500_46_KetUJg.jpg', 68, 0),
(374, 'img_zfwz500_48_InwRYw.jpg', 68, 0),
(376, 'img_zfwz500_51_PDUF9U.jpg', 68, 0),
(377, 'img_zfwz500_lbl_43_KpVPZs.jpg', 68, 0),
(378, 'img_zfwz500_53_Ibg5EF.jpg', 68, 0),
(379, 'img_cnc2000_02_hkiHG3.jpg', 70, 1),
(380, 'img_cnc2000_05_2Twkyf.jpg', 70, 0),
(381, 'img_cnc2000_03_7uV19B.jpg', 70, 0),
(382, 'img_cnc2000_06_41XyNM.jpg', 70, 0),
(383, 'img_cnc2000_07_XftZWP.jpg', 70, 0),
(384, 'img_cnc2000_08_tl3z4.jpg', 70, 0),
(385, 'img_cnc2000_09_Hsw4hS.jpg', 70, 0),
(386, 'cnc2000_148_nBYsg2.jpg', 70, 0),
(387, 'cnc2000_stock-17w_pZpRdX.jpg', 70, 0),
(388, 'cnc2000_stock-26w_16vKv.jpg', 70, 0),
(389, 'cnc2000_lbl_vtGVPQ.jpg', 70, 0),
(390, 'img_cnc2000_10_hFW5Z8.jpg', 70, 0),
(391, 'img_cnc2000_20_guBd2h.jpg', 70, 0),
(392, 'img_cnc2000_24_NbK9X.jpg', 70, 0),
(393, 'img_cnc2000_25_5xORbY.jpg', 70, 0),
(394, 'modulzfwz500_052_peMF8E.jpg', 68, 0),
(396, 'modulzfwz500_046_Yt3qA2.jpg', 68, 0),
(397, 'modulzfwz500_048_oQCx9K.jpg', 68, 0),
(400, 'modulzfwz500_061_NwX2Ah.jpg', 68, 0),
(401, 'modulzfwz500_062_AYnsKW.jpg', 68, 0),
(402, 'modulzfwz500_063_UjF9RF.jpg', 68, 0),
(403, 'modulzfwz500_069_sapysY.jpg', 68, 1),
(404, 'modulzfwz500_060_bfyNLU.jpg', 68, 0),
(408, '1h983_3wx_XRkeFu.jpg', 65, 0),
(409, '5k328_wx_u3rDyE.jpg', 72, 0),
(410, '5k328_3wx_LcFK8k.jpg', 72, 1),
(411, 'pyxwm-250_3wx_DC9XOc.jpg', 73, 1),
(412, 'pyxwm-250_1wx_qLMN6O.jpg', 73, 0),
(417, 'k274a_315_3wb_SIBxqw.jpg', 75, 1),
(418, 'k274a_315_5_y76Ag8.jpg', 75, 0),
(420, '5k328_6wx_HHnbGd.jpg', 72, 0),
(421, '5k328_5wx_UMxv5i.jpg', 72, 0),
(422, '5k328_8wx_WVIPVo.jpg', 72, 0),
(423, '5k328_9wx_5WahWE.jpg', 72, 0),
(424, '5k328_4wx_4nmVF7.jpg', 72, 0),
(425, '1h983_2wx_dxYluq.jpg', 65, 0),
(426, 'k274a_315_1wb_qedDcI.jpg', 75, 0),
(427, 'sfw200x600_sept21_AP1LwP.jpg', 76, 1),
(428, 'sfw-600_1wbx_6FpHRB.jpg', 76, 0),
(429, 'm400_01_lQT6ma.jpg', 77, 1),
(430, 'm400_03_qM4Cvj.jpg', 77, 0),
(431, 'm400_11_r64RVP.jpg', 77, 0),
(432, 'm400_lbl_0I3k0b.jpg', 77, 0),
(433, 'rt211_03_75Xlh5.jpg', 78, 1),
(434, 'rt211_07_MBKHN9.jpg', 78, 0),
(435, 'rt211_06_w4OpMK.jpg', 78, 0),
(436, 'pyxwm-250_lbl78_snd_hDUFx.jpg', 73, 0),
(437, 'kaapast203_5_ImjiY2.jpg', 79, 1),
(438, 'kaapast203_7_ULHqMk.jpg', 79, 0),
(439, 'kaapast203_2_3DeU8.jpg', 79, 0),
(440, 'ast203_lbl8_DjryYV.jpg', 79, 0),
(454, 'henrypels_BBNYGs.jpg', 44, 1),
(455, 'pels-630_3wb_W4k5RO.jpg', 44, 0),
(456, 'pels-630_6wb_hTDc6L.jpg', 44, 0),
(457, 'pels-630_1wb_Jb08Tf.jpg', 44, 0),
(458, 'tosoho-50_5wb_0VaKyk.jpg', 83, 1),
(459, 'tosoho-50_10wb_ChsM25.jpg', 83, 0),
(460, 'tosoho-50_11wb_YAo05.jpg', 83, 0),
(461, 'tosoho-50_12wb_myKuaS.jpg', 83, 0),
(462, 'tosoho-50_14wb_riVtaS.jpg', 83, 0),
(463, 'tosoho-50_18wb_Pz58gE.jpg', 83, 0),
(464, 'tosoho-50_15wb_FUU135.jpg', 83, 0),
(465, 'afc350-2000_5_Npn5tq.jpg', 84, 1),
(466, 'afc350-2000_8_7nTEdA.jpg', 84, 0),
(467, 'img_1146_Kv3qkb.jpg', 84, 0),
(468, 'afc-350-2000_electriccab_H0QlDN.jpg', 84, 0),
(469, 'afc350-2000_31_kYIvvO.jpg', 84, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `shipments`
--

CREATE TABLE `shipments` (
  `id` int(10) UNSIGNED NOT NULL,
  `img` tinytext NOT NULL,
  `descr` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shipments`
--

INSERT INTO `shipments` (`id`, `img`, `descr`) VALUES
(39, 'dsc09388_LXGdCV.jpg', 'VTL Tos Sk12'),
(40, 'dsc09389_CkT5mT.jpg', 'VTL Tos Sk12a'),
(41, 'loadkb9534_1_UBs7YG.jpg', 'TMP Kb9534'),
(42, 'loadkb9534_2_zychYI.jpg', 'TMP KB9534'),
(43, 'loadkb9534_3_kfEsMo.jpg', 'TMP Kb9534'),
(44, '5230_5230_31_aModm2.jpg', 'Saratov 5230'),
(45, '5230_zfwvg250_34_KFrmrh.jpg', 'Heckert ZFWVG 250 - 800'),
(46, 'tosh80a_loading_17_UXYUSj.jpg', 'HBM Tos H80A'),
(47, 'tosh80a_loading_7_0FA0Mr.jpg', 'HBM Tos H80A'),
(48, 'tosh80a_loading_14_J5vZyP.jpg', 'HBM Tos H80A'),
(49, 'c-1335_shipment_3_NGoNd.jpg', 'Forging Roll Voronezh C1335'),
(50, 'c-1335_shipment_7_GJHsjW.jpg', 'Voronezh C-1335'),
(51, 'gus_28_mPEtUT.jpg', 'Lindner GUS-B, Dec-2019'),
(52, 'loadgus-b_matrix39_1_JoTvvN.jpg', 'Matrix-39, Aug-2020'),
(53, 'loadgus-b_matrix39_2_4Ad3LP.jpg', 'Lindner Gus-B, Sept-2020'),
(54, 'loadgus-b_matrix39_4_Bl9kZP.jpg', 'Thread grinders, Sept-2020'),
(55, 'loadfp3a_1_tUloSb.jpg', 'Deckel FP3A, Feb-2021'),
(56, 'fo6_20210310_load2_gBy7t2.jpg', 'Tos Fo6, March 2021'),
(57, 'fo10_20210310_load1_G83Vq1.jpg', 'Tos Fo10, March 2021'),
(58, 'fo6-fo10_210310_load7_4hPucw.jpg', 'Fo6-Fo10, March 2021'),
(59, 'fo10_210310_load5_Fohhwg.jpg', 'Tos Fo10, March 2021'),
(60, 'ontruckimg-20210909-wa0002_zCNq7v.jpg', 'Dessau PYXWM250.1 Sept 2021');

-- --------------------------------------------------------

--
-- Структура таблицы `sort`
--

CREATE TABLE `sort` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `sort_Method` varchar(255) NOT NULL DEFAULT 'SELECT * FROM stock ORDER BY id ASC'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sort`
--

INSERT INTO `sort` (`id`, `sort_Method`) VALUES
(1, ' SELECT * FROM stock ORDER BY id ASC ');

-- --------------------------------------------------------

--
-- Структура таблицы `stock`
--

CREATE TABLE `stock` (
  `id` smallint(3) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT 'Name',
  `short_name` varchar(40) NOT NULL DEFAULT 'Short Name',
  `description` text NOT NULL,
  `hot` tinyint(1) DEFAULT '0',
  `sold` tinyint(1) DEFAULT '0',
  `default_img` varchar(55) NOT NULL DEFAULT 'default.jpg',
  `view` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `date` date NOT NULL,
  `status` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `stock`
--

INSERT INTO `stock` (`id`, `name`, `short_name`, `description`, `hot`, `sold`, `default_img`, `view`, `date`, `status`) VALUES
(28, 'Hob-Spline shaft grinding machine WMW VEB ', 'Heckert ZSKW-400-1000', 'Manufacturer:  VEB HECKERT, Germany&lt;br&gt;\r\nType/Model:  ZSKW 400 x 1000&lt;br&gt;\r\nNew in: 1978&lt;br&gt;\r\nControl: conventional &lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt;Technical Data:&lt;/strong&gt;&lt;p&gt;\r\n&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;Grinding diametr: upto 400 mm &lt;/li&gt;\r\n&lt;li&gt;Grinding length: 1000 mm &lt;/li&gt;\r\n&lt;li&gt;Clamping length: upto 1120 mm &lt;/li&gt;\r\n&lt;li&gt;Weight machine:  4,7 tn &lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 38, '2019-03-02', 0),
(40, ' Tos KURIM', 'Tos FCV-50NC', 'Vertical milling machine&lt;br&gt;\r\nManufacturer: Tos, KURIM, Cz&lt;br&gt;\r\nType/Model: FCV 50 NC&lt;br&gt;\r\nControl: conventional with DRO 3 axis&lt;br&gt;\r\n&lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt; Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;-Clamping surface area table 500 x 2000mm &lt;/li&gt;\r\n&lt;li&gt;-Max.table loading: 1150 Kg &lt;/li&gt;\r\n&lt;li&gt;-Travels X-Y-Z: 1850/640/580mm &lt;/li&gt;\r\n&lt;li&gt;-Spindle taper ISO-50 (Sk50) &lt;/li&gt;\r\n&lt;li&gt;-Distance spindle axis from the table: &lt;/li&gt;\r\n&lt;li&gt; Max. 640 mm&lt;/li&gt;\r\n&lt;li&gt; Min 80 mm&lt;/li&gt;\r\n&lt;li&gt;-Range of spindle speed:&lt;/li&gt;\r\n&lt;li&gt; normal 45 - 1400 Rpm&lt;/li&gt;\r\n&lt;li&gt; reduced - optional 35,4 - 1120 Rpm&lt;/li&gt;\r\n&lt;li&gt;- Range of Feeds: &lt;/li&gt;\r\n&lt;li&gt; Longitudial of table 10 - 2000 mm/min&lt;/li&gt;\r\n&lt;li&gt; Vertical of spindle  2.5 - 500 mm/min&lt;/li&gt;\r\n&lt;li&gt;-Main drive motor power 14 Kw &lt;/li&gt;\r\n&lt;li&gt;-Power of Electric motor for feed 3 kW &lt;/li&gt;\r\n&lt;li&gt;-Dimensions: 2980 x 2400 x 2200 mm &lt;/li&gt;\r\n&lt;li&gt;-Weight (approx.) 6,75 tn &lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 31, '2019-08-23', 0),
(41, 'ERFURT Deep Drawing  single Crank double actions press', 'Erfurt PKnT-160', 'ERFURT Deep Drawing Single Crank press&lt;Br&gt;\r\nManufacturer: WMW, ERFURT, Germany&lt;br&gt;\r\nType/Model: PKnT-160&lt;br&gt;\r\nControl: conventional&lt;br&gt;\r\n&lt;br&gt;&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;Force capacity  160 ton&lt;/li&gt;\r\n&lt;li&gt;Force of slide 22 mm before lowest position 95 tn&lt;/li&gt;\r\n&lt;li&gt;Deepth drawing 200 mm&lt;/li&gt;\r\n&lt;li&gt;Adjastment  130 mm&lt;/li&gt;\r\n&lt;li&gt;Force ejector 4 tn &lt;/li&gt;\r\n&lt;li&gt;Table size: 800 x 800 mm&lt;/li&gt;\r\n&lt;li&gt;Slide size: 500 x 500 mm&lt;/li&gt;\r\n&lt;li&gt;Shutheight 575 mm &lt;/li&gt;\r\n&lt;li&gt;-Slide stroke 425 mm &lt;/li&gt;\r\n&lt;li&gt;-Main drive motor power 17.5 Kw &lt;/li&gt;\r\n&lt;li&gt;-Weight (approx.) 18,5 tn &lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 65, '2019-09-02', 0),
(44, 'Trimming press', 'PELS  DC-630/1000', 'Manufacturer: WMW, PELS, Germany&lt;br&gt;\r\nType/Model: DC 630/1000&lt;br&gt;\r\nControl: conventional&lt;br&gt;\r\n&lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;-Force capacity: 630t  (630Mp)&lt;/li&gt;\r\n&lt;li&gt;-Table size: 1000 x 1520 mm&lt;/li&gt;\r\n&lt;li&gt;-Ram size: 820 x 1180 mm&lt;/li&gt;\r\n&lt;li&gt;-Shut height:    685 mm &lt;/li&gt;\r\n&lt;li&gt;-Stroke of Ram:  390 mm &lt;/li&gt;\r\n&lt;li&gt;-Adjastment:     130 mm&lt;/li&gt;\r\n&lt;li&gt;-Number of strokes: 12 per min &lt;/li&gt;\r\n&lt;li&gt;-Main drive motor power 45 Kw&lt;/li&gt;\r\n&lt;li&gt;-Weight of machine(approx.): 50t&lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 45, '2019-09-25', 1),
(46, 'Single crank Trimming press', 'ERFURT PKZ-800', 'Manufacturer: WMW, ERFURT, Germany&lt;br&gt;\r\nType/Model: PKZ-800&lt;br&gt;\r\nControl: conventional&lt;br&gt;\r\nNew in: 1979&lt;Br&gt;\r\n&lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;-Force capacity: 800 Mp (800t)&lt;/li&gt;\r\n&lt;li&gt;-Clamping force: 125 Mp (125t)&lt;/li&gt;\r\n&lt;li&gt;-Table size: 1250 x 1650 mm&lt;/li&gt;\r\n&lt;li&gt;-Ram size:   1000 x 1250 mm&lt;/li&gt;\r\n&lt;li&gt;-Shut height:    635 mm &lt;/li&gt;\r\n&lt;li&gt;-Stroke of Ram:  400 mm &lt;/li&gt;\r\n&lt;li&gt;-Adjastment:     185 mm&lt;/li&gt;\r\n&lt;li&gt;-Number of strokes: 12 per min &lt;/li&gt;\r\n&lt;li&gt;-Main drive motor power 55 Kw&lt;/li&gt;\r\n&lt;li&gt;-Dimensions of machine:&lt;/li&gt;\r\n&lt;li&gt;  Width:	2790 mm&lt;/li&gt;\r\n&lt;li&gt;  Length:	3800 mm&lt;/li&gt;\r\n&lt;li&gt;Heigh above floor level: 6920 mm&lt;/li&gt;\r\n&lt;li&gt;-Weight of machine(approx.): 77t&lt;/li&gt;\r\n&lt;/ul&gt;\r\n', 0, 0, 'default.jpg', 14, '2019-10-28', 0),
(48, 'Gear shaper Tos Čel&aacute;kovice n.p.', 'Tos OH-6', 'Manufacturer: TOS Čel&aacute;kovice n.p.&lt;Br&gt;\r\nType/Model: OH-6&lt;Br&gt;\r\nNew in: 1976&lt;Br&gt;\r\n&lt;Br&gt;&lt;p&gt;&lt;strong&gt; Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot;&gt;&lt;Br&gt;              \r\n&lt;li&gt; -Max.slotting wheel diam.: 500 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. module: 6 mm&lt;/li&gt;\r\n&lt;li&gt; -Table diameter: 450 mm&lt;/li&gt;\r\n&lt;li&gt; -Stozel Strokes: 50-315 str/min&lt;/li&gt; \r\n&lt;li&gt; -Power main drive motor: 3 kW&lt;/li&gt;\r\n&lt;li&gt; -Dimensions: 2100x1000x2100 mm&lt;/li&gt;\r\n&lt;li&gt; -Weight machine: 3,5 tn&lt;/li&gt;\r\n&lt;/ul&gt;\r\n&lt;p&gt;Accessories:&lt;/b&gt;&lt;br/&gt;&lt;ul ENGINE=&quot;square&quot;&gt;\r\n&lt;li&gt;-tool holders&lt;/li&gt;\r\n&lt;li&gt;-set of change gears&lt;/li&gt;', 0, 0, 'default.jpg', 98, '2019-11-28', 1),
(65, 'Pipe turning engine lathe RYAZAN', '1H983', 'Conventional pipe-thread cutting lathe &lt;/br&gt;\r\nManufacturer: RYAZAN, Russia&lt;/br&gt;\r\nType/ Model: 1H983&lt;/br&gt;\r\nNew in:  1987&lt;/br&gt;\r\n&lt;ul ENGINE=&quot;square&quot;&gt;&lt;li&gt;Technical details:&lt;/li&gt;\r\n&lt;li&gt;Spindel bore: 370 mm &lt;/li&gt;\r\n&lt;li&gt;Swing over bed: 1050 mm &lt;/li&gt;\r\n&lt;li&gt;Swing over carriage: 525 mm&lt;/li&gt;\r\n&lt;li&gt;Distance between centres: 1000 mm&lt;/Ii&gt;\r\n&lt;li&gt;Spindel Speed range: 8 - 355 rpm, speed adjustment 12 steps &lt;/li&gt;\r\n&lt;li&gt;Height of centers over bed: 550 mm&lt;/li&gt;\r\n&lt;li&gt;Feeds:&lt;/li&gt;\r\n&lt;li&gt;Cutting feed range: 0,042-1,179mm/min &lt;/li&gt;\r\n&lt;li&gt; Cut thread range:  0,09-2,67mm/rev &lt;/li&gt;\r\n&lt;li&gt;Tailstock: quill travel - 240 mm &lt;/li&gt;\r\n&lt;li&gt; Quill Taper:  MT6\r\n&lt;li&gt;Electric motor:  17 kW &lt;/li&gt;\r\n&lt;li&gt;Weight machine:  9.7 t &lt;/li&gt;\r\n&lt;li&gt; DIMENSIONS: 3640 x 2050 x 1675 mm &lt;/li&gt;/ul&gt;\r\n \r\n', 0, 0, 'default.jpg', 32, '2021-03-05', 1),
(66, 'Engine Lathe Tos Trencin SV18RA', 'Tos Trencin SV18RA', 'Universal engine turning lathe &lt;br/&gt;\r\nManufacturer: Tos Trencin, Cz &lt;br/&gt;\r\nType/ Model: SV18 Standard design &lt;br/&gt;\r\nNew in: 1973 &lt;br/&gt; \r\n&lt;ul ENGINE=&quot;square&quot;&gt;&lt;li&gt;Technical details:&lt;/li&gt;\r\n&lt;li&gt;Swing over bed: 360 mm &lt;/li&gt;\r\n&lt;li&gt;Swing over carriage: 215 mm&lt;/li&gt;\r\n&lt;li&gt;Distance between centres: 1250 mm&lt;/Ii&gt;\r\n&lt;li&gt;Speed range: 14- 2800 rpm &lt;/li&gt;\r\n&lt;li&gt;Height of centers over bed: 105 mm&lt;/li&gt;\r\n&lt;li&gt;Hole through spindle, diameter: 41 mm&lt;/li&gt;\r\n&lt;li&gt;Number of spindle speeds: 21 &lt;/li&gt;\r\n&lt;li&gt;Electric motor:  6 kW &lt;/li&gt;\r\n&lt;li&gt;Weight machine:  1.73 t &lt;/li&gt;', 0, 0, 'default.jpg', 72, '2021-03-06', 0),
(67, 'UMARO ARAD Romania SN501', 'ARAD SN501', 'Universal engine turning lathe &lt;br/&gt;\r\nManufacturer: UMARO ARAD, Romania &lt;br/&gt;\r\nType/ Model: SN501 Long design &lt;br/&gt;\r\nNew in: 1983 &lt;br/&gt;\r\n&lt;ul ENGINE=&quot;square&quot;&gt;&lt;li&gt;Technical details:&lt;/li&gt;\r\n&lt;li&gt;Swing over bed: 630 mm &lt;/li&gt;\r\n&lt;li&gt;Swing over carriage: 315 mm&lt;/li&gt;\r\n&lt;li&gt;Distance between centres: 2000 mm&lt;/Ii&gt;\r\n&lt;li&gt;Speed range: 14- 2800 rpm &lt;/li&gt;\r\n&lt;li&gt;Height of centers over bed: 105 mm&lt;/li&gt;\r\n&lt;li&gt;Hole through spindle, diameter: 41 mm&lt;/li&gt;\r\n&lt;li&gt;Number of spindle speeds: 21 &lt;/li&gt;\r\n&lt;li&gt;Electric motor:  10 kW &lt;/li&gt;\r\n&lt;li&gt;Weight machine:  2.5 t &lt;/li&gt;', 0, 0, 'default.jpg', 12, '2021-03-15', 0),
(68, 'Gear Hobber WMW Modul ', 'MODUL ZFWZ 500 x 8', 'Gear Hobbing machine&lt;Br&gt;\r\nManufacturer: WMW VEB MODUL Karl-Marx Stadt, DDR&lt;Br&gt;\r\nType/Model: ZFWZ-500x8&lt;Br&gt;\r\nNew in: 1978&lt;Br&gt;\r\n&lt;Br&gt;&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;&lt;Br&gt;             \r\n&lt;li&gt; -Max.hobbing wheel diam.: 500 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. module: 8 mm&lt;/li&gt;\r\n&lt;li&gt; -Table diameter: 470 mm&lt;/li&gt;\r\n&lt;li&gt; -Max mill-cutter diameter: 160 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. width of cutters: 250 mm&lt;/li&gt;\r\n&lt;li&gt; -Milling head: - swivable +/- 30 &deg;&lt;/li&gt;\r\n&lt;li&gt; -Power main drive motor: 7.2 kW&lt;/li&gt;\r\n&lt;li&gt; -Voltage: 400V 50 Hz, 3 phaze&lt;/li&gt;\r\n&lt;li&gt; -Total power requirement: 9,0 kW&lt;li&gt;\r\n&lt;li&gt; -Dimensions of machine: 2740x 1350 x1970 mm&lt;/li&gt;\r\n&lt;li&gt; -Weight of machine: 6500 Kg&lt;/li&gt;&lt;/ul&gt;\r\n&lt;p&gt;Accessories:&lt;/b&gt;&lt;br/&gt;&lt;ul ENGINE=&quot;square&quot;&gt;\r\n&lt;li&gt;- Coolant tank with pomp&lt;/li&gt;\r\n&lt;li&gt;- Manual book&lt;/li&gt;\r\n&lt;li&gt;- 2 pcs of tool arbors&lt;/li&gt;\r\n&lt;li&gt;- Set of change gears approx.43 pcs.&lt;/li&gt;\r\n&lt;li&gt;- Set of milling cutters for additional payment &lt;/ul&gt;', 0, 0, 'default.jpg', 59, '2021-05-24', 1),
(70, 'Cnc Lathe Colchester cnc 2000', 'Colchester cnc2000, 210 x 1250', 'Manufacturer: COLCHESTER, ESSEX, England&lt;br&gt;\r\nTyp/Model: CNC 2000&lt;br&gt;\r\nControl: FANUC Series OTC&lt;br&gt;\r\nSerial number: LR22 SR6784A-2009&lt;br&gt;\r\nNew in: 2009&lt;br&gt;\r\n&lt;br&gt;&lt;strong&gt;Breef Technical data:&lt;/strong&gt;&lt;/p&gt;&lt;ul ENGINE=&quot;square&quot;&gt;\r\n&lt;li&gt;Max.swing diameter over bed: 400mm&lt;/li&gt;\r\n&lt;li&gt;Max.Turning diam.over carriage: 249mm&lt;/li&gt;\r\n&lt;li&gt;Max.Turning length btwn centres: 1250mm&lt;/li&gt;\r\n&lt;li&gt;Spindle speed : 6-2750 Rpm&lt;/li&gt;\r\n&lt;li&gt;Revolving turret SAUTER 05.480.312, 8 positions with size  VDI30&lt;/li&gt;\r\n&lt;li&gt;Power of maindrive motor: 7,5 kW&lt;/li&gt;\r\n&lt;li&gt;Chuck ROHM KFD-HE210/3, 3-Jaws with  hydroclamping&lt;li/&gt;\r\n&lt;li&gt;Weight machine: 2360 Kg&lt;/li&gt;&lt;Br&gt;\r\n&lt;li&gt;Accessroies:&lt;/li&gt;\r\n&lt;li&gt; Set of tool holders VDI30&lt;li/&gt;\r\n&lt;li&gt; Manual Books on germany/english&lt;li/&gt;\r\n&lt;li&gt; Oil tank with pomp&lt;li/&gt;&lt;/ul&gt;', 0, 0, 'default.jpg', 132, '2021-06-07', 1),
(72, 'Gear hobbing machine STANKO', 'Stanko 5k328 1250x14', 'Gear Hobbing machine&lt;Br&gt;\r\nManufacturer: STANKO, Russia&lt;Br&gt;\r\nType/Model: 5K328&lt;Br&gt;\r\nNew in: 1978&lt;Br&gt;&lt;Br&gt;\r\n&lt;p&gt;&lt;strong&gt; Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot;&gt;&lt;Br&gt;             \r\n&lt;li&gt; -Max.hobbing wheel diam.: 1250 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. module: 14 mm&lt;/li&gt;\r\n&lt;li&gt; -Table diameter: 950 mm&lt;/li&gt;\r\n&lt;li&gt; -Max cutter diameter: 170 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. width of cutters: 400 mm&lt;/li&gt;\r\n&lt;li&gt; -milling spindle speed:   20 - 225 Rpm&lt;/li&gt;\r\n&lt;li&gt; -Power main drive motor: 18 kW&lt;/li&gt;\r\n&lt;li&gt; -Dimensions: 3240x 1640 x2170 mm&lt;/li&gt;\r\n&lt;li&gt; -Weight machine: 18,3 tn&lt;/li&gt;\\r\\n&lt;/ul&gt;\r\n&lt;p&gt;Accessories:&lt;/b&gt;&lt;br/&gt;&lt;ul ENGINE=&quot;square&quot;&gt;\r\n&lt;li&gt;-tool holders&lt;/li&gt;\r\n&lt;li&gt;-Manual Book&lt;/li&gt;\r\n&lt;li&gt;-set of change gears&lt;/li&gt;', 0, 0, 'default.jpg', 19, '2021-07-27', 0),
(73, 'Horizontal hydraulic Railwheel mounting (bulldozer type) press made WMW Dessau, Germany', 'DESSAU PYXWM-250.1', 'Manufacturer: WMW, DESSAU, Germany&lt;br&gt;\r\nType/Model: PYXWM-250.1&lt;br&gt;\r\nControl: conventional&lt;br&gt;\r\n&lt;br&gt;&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;-Force capacity: 250t  (250Mp)&lt;/li&gt;\r\n&lt;li&gt;-Table size: 1000 x 820 mm&lt;/li&gt;\r\n&lt;li&gt;-Ram size: 600 x 1000 mm&lt;/li&gt;\r\n&lt;li&gt;-Max. Shut height:    1750 mm &lt;/li&gt;\r\n&lt;li&gt;-Stroke of Ram:  580 mm &lt;/li&gt;\r\n&lt;li&gt;-Adjastment:     315 mm&lt;/li&gt;\r\n&lt;li&gt;-Strokes: 0,22 mm/sec &lt;/li&gt;\r\n&lt;li&gt;-Total power requirement: 11 Kw&lt;/li&gt;\r\n&lt;li&gt;-Weight of machine:  9.7 t&lt;/li&gt;&lt;/ul&gt;', 0, 0, 'default.jpg', 48, '2021-07-28', 0),
(75, 'Single crank trimming press VORONEZH TMP-315', 'Voronezh TMP 315 t', 'Description:&lt;br&gt;\r\nManufacturer: VORONEZH, TMP, Russia&lt;br&gt;\r\nType/Model: K-274a&lt;br&gt;\r\nControl: conventional&lt;br&gt;\r\nNew in: 1981&lt;br&gt;\r\n&lt;br&gt; Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt; \r\n&lt;li&gt;&bull;	-Force capacity: 315 Mp (315t)&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Clamping force: 42 Mp (4,2t)&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Table size: 1000 x 1120 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Ram size: 800 x 950 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Shut height: 685 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Stroke of Ram: 280 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Adjastment: 180 mm&lt;/li&gt;\r\n&lt;li&gt;&bull;	-Number of strokes: 10 per min&lt;/li&gt;\r\n&lt;li&gt;&bull;	-Main drive motor power 34 Kw&lt;/li&gt;\r\n&lt;li&gt;&bull;	-Dimensions of machine:&lt;/li&gt;	\r\n&lt;li&gt;&bull;	Width: 2840 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	Length: 2180 mm&lt;/li&gt;\r\n&lt;li&gt;&bull;	Heigh above floor level: 5860 mm&lt;/li&gt;	\r\n&lt;li&gt;&bull;	-Weight of machine(approx.): 32.7t&lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 33, '2021-08-28', 0),
(76, 'Surface grinding machine tool WMW SFW 200x600', 'WMW SFW-200/600', 'Manufacturer:  WMW HECKERT, Germany&lt;br&gt;\r\nType/Model:  SFW 200x600&lt;br&gt;\r\nNew in: 1971&lt;br&gt;\r\nControl: conventional &lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt;Technical Data:&lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;Grinding width: upto 200 mm &lt;/li&gt;\r\n&lt;li&gt;Grinding length: upto 600 mm &lt;/li&gt;\r\n&lt;li&gt;Grinding heigh: upto 265 mm&lt;/li&gt;\r\n&lt;li&gt;Weight machine:  1,1 tn &lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 12, '2021-09-05', 0),
(77, 'Engine Lathe Harrison', 'Harrison M400', 'Manufacturer: Harrison, Halifax, England&lt;Br/&gt;\r\nType/Model: M400&lt;Br/&gt;\r\nNew in: 1989&lt;Br/&gt;\r\n&lt;Br/&gt;\r\n&lt;ul ENGINE=&quot;square&quot;&gt;&lt;li&gt;Technical details:&lt;/li&gt;\r\n&lt;li&gt;Swing over bed: 380 mm &lt;/li&gt;\r\n&lt;li&gt;Swing over carriage: 350 (14&quot;) mm&lt;/li&gt;\r\n&lt;li&gt;Distance between centres: 1000 (40&quot;) mm&lt;/Ii&gt;\r\n&lt;li&gt;Voltage: 110/220/380V,  3PH,  50 Hz\r\n&lt;li&gt;Power of main drive motor: 5.7 kW \r\n&lt;li&gt;-Weight of machine:  1890 Kgt&lt;/li&gt;&lt;/ul&gt;\r\n', 0, 0, 'default.jpg', 18, '2021-09-23', 1),
(78, 'Engine Lathe RYAZAN RT211', 'Ryazan RT211 630x2800', 'Manufacturer: Ryazan, Russia&lt;Br&gt;\r\nType/ Model:  RT-211&lt;Br&gt;\r\nNew in: 1991&lt;Br&gt;\r\nCapacity: 630 x 2850mm&lt;Br&gt;\r\n', 0, 0, 'default.jpg', 4, '2021-09-23', 0),
(79, 'Hob Grinding machine KAAP', 'KAAP AST-203', 'Hob gear grinding machine&lt;Br&gt;\r\nManufacturer: KAAP &amp; Co, Coburg, Germany &lt;Br&gt;\r\nType/Model: AST-203&lt;Br&gt;\r\nNew in: 1973&lt;Br&gt;\r\n&lt;Br&gt;&lt;p&gt;&lt;strong&gt;    Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot; &gt;&lt;Br&gt;              \r\n&lt;li&gt; -Max.grinding diam.: 200 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. module: 22 mm&lt;/li&gt;\r\n&lt;li&gt; -Min. Module:  1 mm&lt;/li&gt;\r\n&lt;li&gt; -Distance between centres: 345 mm&lt;/li&gt;\r\n&lt;li&gt; -Centre heigh: 105 mm&lt;/li&gt;\r\n&lt;li&gt; -Max. Clamping length: 4400 mm&lt;/li&gt;\r\n&lt;li&gt; -Spindle turning speed range:&nbsp;&nbsp;&nbsp;3000, 4000, 6000 U/min&lt;/li&gt;\r\n&lt;li&gt; -Grinding head: - swivable +/- 20 &deg;&lt;/li&gt;\r\n&lt;li&gt; -Power main drive motor: 1.5 kW&lt;/li&gt;\r\n&lt;li&gt; -Voltage: 400V 50 Hz, 3 phaze&lt;/li&gt;\r\n&lt;li&gt; -Total power requirement: 3,2 kW&lt;li&gt;\r\n&lt;li&gt; -Dimensions of machine: 2140x 1350 x1870 mm&lt;/li&gt;\r\n&lt;li&gt; -Weight of machine: 2150 Kg&lt;/li&gt;&lt;/ul&gt;', 0, 0, 'default.jpg', 12, '2021-09-24', 0),
(83, 'Tos Celakocice n.p. Cz', 'Tos OHO-50', 'Manufacturer: TOS Čel&aacute;kovice n.p.&lt;Br&gt;\r\nType/Model: OHO-50&lt;Br&gt;\r\nNew in: 1980&lt;Br&gt;\r\n&lt;Br&gt;&lt;p&gt;&lt;strong&gt; Technical data: &lt;/strong&gt;&lt;p&gt;&lt;ul ENGINE = &quot;square&quot;&gt;&lt;Br&gt;\r\n &lt;li&gt; -Max.slotting wheel diam.: 500 mm&lt;/li&gt;\r\n&lt;li&gt; -Machining of  module: 1-6 mm&lt;/li&gt;\r\n&lt;li&gt; -Max.gear wheel width: 125 mm&lt;/li&gt;\r\n&lt;li&gt; -Table diameter: 500 mm&lt;/li&gt;\r\n&lt;li&gt; -Stozel Strokes: 56-355 str/min&lt;/li&gt; \r\n&lt;li&gt; -Power main drive motor: 4 kW&lt;/li&gt;\r\n&lt;li&gt; -Dimensions: 1870x895x1920 mm&lt;/li&gt;\r\n&lt;li&gt; -Weight machine: 3500 Kg&lt;/li&gt;\r\n&lt;/ul&gt;\\r\\n&lt;p&gt;Accessories:&lt;/b&gt;&lt;br/&gt;&lt;ul ENGINE=&quot;square&quot;&gt;\r\n&lt;li&gt;-tool holders&lt;/li&gt;\r\n&lt;li&gt;manual Book&lt;/li&gt;\r\n&lt;li&gt;-set of change gears&lt;/li&gt;', 0, 0, 'default.jpg', 177, '2021-11-28', 1),
(84, 'Cylindrical External-Internal Grinder', 'FORTUNA AFC 350-2000', 'Manufacturer:  Fortuna Werke AG, Germany&lt;br&gt;\r\nType/Model:  AFC 350 x 2000&lt;br&gt;\r\nNew in: 1976&lt;br&gt;\r\nControl: conventional &lt;br&gt;\r\n&lt;p&gt;&lt;strong&gt;Technical Data:&lt;/strong&gt;&lt;p&gt;\r\n&lt;ul ENGINE = &quot;square&quot; &gt;\r\n&lt;li&gt;Grinding diametr: upto 350 mm &lt;/li&gt;\r\n&lt;li&gt;Centers heigh:  180 mm &lt;/li&gt;\r\n&lt;li&gt;Grinding length: 2000 mm &lt;/li&gt;\r\n&lt;li&gt;Clamping length: upto 1950 mm &lt;/li&gt;\r\n&lt;li&gt;Weight machine:  5,5 tn &lt;/li&gt;\r\n&lt;/ul&gt;', 0, 0, 'default.jpg', 100, '2022-01-14', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` smallint(6) NOT NULL,
  `login` char(255) DEFAULT NULL,
  `password` char(255) DEFAULT NULL,
  `email` char(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `email`) VALUES
(1, 'admin', '$2y$10$JHp7/cliHEwGBwDWV.n7ruACk0Gtz5hr//zN55vOg8k7yJf0zivPq', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Структура таблицы `webuy`
--

CREATE TABLE `webuy` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `name` text,
  `name_en` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `webuy`
--

INSERT INTO `webuy` (`id`, `name`, `name_en`) VALUES
(2, 'Токарно-карусельный станок следующих моделей1525 & 1L532 kомплектном состоянии .', NULL),
(3, 'Бесцентровошлифовальные станки пр-ва ГДР мод.SASL-5, мод.SXK-5A, мод.SZK-3', NULL),
(4, 'Вальцы ковочные мод.С/СА-1335, С-1336 в любом состоянии', NULL),
(5, 'Зубофрезерный станок мод.5230; CT267', NULL),
(7, 'Пресс чеканочный К8338, пресс обрезной К9534, К9536, горяче-ковочний пресс Шмераль LZK-1600', NULL),
(10, 'Фантастические видения', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `webuy_en`
--

CREATE TABLE `webuy_en` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `webuy_en`
--

INSERT INTO `webuy_en` (`id`, `name`) VALUES
(1, '&lt;strong&gt;PREFERERY purchsing:&lt;/strong&gt;'),
(2, 'The Centreless grinders: WMW MIKROSA Sasl-125/1E, 125/1A,  SASL-5/1ad;  Cincinnati 3-350'),
(3, 'Gear Hobbing &amp; gear Shapers machines following brands: Lorenz  type SN / S8-630, Liebherr  type LC/ LF , Pfauter type PE400, Tos Celakovice OHA50A, Tos OF71,  Tos Fo16..etc/ PE'),
(4, '&lt;strong&gt;ALWAYS purchasing:&lt;/strong&gt;\r\nVTL Tos Hulin SK16, SKQ16'),
(5, 'VTL Cnc &amp; conventional : with table size: 1200-1800 mm following brands: SCHIESS, FORIEP, DORRIES,  TOS'),
(6, '&lt;strong&gt;Today purchasing:&lt;/strong&gt;\r\n'),
(7, 'Gear Hobbing &amp; gear Shapers &amp; gear Grinding machines following brands: Lorenz, Liebherr, Pfauter,  Reishauer RZ700'),
(8, '&lt;strong&gt;Hot forging press made in:&lt;/strong&gt;\r\n'),
(9, 'SMERAL, Voronezh; Upsetter for Bolt &amp; Nut  made NATIONAL (USA)');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `aboutus`
--
ALTER TABLE `aboutus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contacts_en`
--
ALTER TABLE `contacts_en`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shipments`
--
ALTER TABLE `shipments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sort`
--
ALTER TABLE `sort`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_id_uindex` (`id`),
  ADD UNIQUE KEY `users_password_uindex` (`password`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

--
-- Индексы таблицы `webuy`
--
ALTER TABLE `webuy`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `webuy_en`
--
ALTER TABLE `webuy_en`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `aboutus`
--
ALTER TABLE `aboutus`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `contacts_en`
--
ALTER TABLE `contacts_en`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `home`
--
ALTER TABLE `home`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=470;

--
-- AUTO_INCREMENT для таблицы `shipments`
--
ALTER TABLE `shipments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT для таблицы `sort`
--
ALTER TABLE `sort`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `stock`
--
ALTER TABLE `stock`
  MODIFY `id` smallint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `webuy`
--
ALTER TABLE `webuy`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `webuy_en`
--
ALTER TABLE `webuy_en`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
