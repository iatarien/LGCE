INSERT INTO `titres` (`id_titre`, `code`, `definition`, `definition_fr`, `type`, `father`) VALUES (NULL, '33000', 'تخصيصات الاستثمار للمؤسسات العمومية ذات الطابع الإداري و المؤسسات العمومية المماثلة الأخرى', NULL, 'parent', '0');
UPDATE titres SET definition = 'المنشآت' WHERE code = 31410;
UPDATE titres SET definition = 'المنشآت البحرية' WHERE code = 31411;
UPDATE titres SET definition = 'المنشآت للطرقات' WHERE code = 31412;
UPDATE titres SET definition = 'المنشآت للمطارات' WHERE code = 31413;
UPDATE titres SET definition = 'المنشآت للسكك الحديدية' WHERE code = 31414;
UPDATE titres SET definition = 'المنشآت للري' WHERE code = 31415;
UPDATE titres SET definition = 'المنشآت الرياضية' WHERE code = 31416;
UPDATE titres SET definition = 'المنشآت الطاقوية والمواصلات السلكية واللاسلكية و تكنولوجيات الإعلام و الإتصال' WHERE code = 31417;
UPDATE titres SET definition = 'المنشآت  لمعالجة النفايات والمياه المستعملة' WHERE code = 31418;
UPDATE titres SET definition = 'المنشآت العسكرية' WHERE code = 31450;
UPDATE titres SET definition = 'التركيبات التقنية والخاصة' WHERE code = 31610;
UPDATE titres SET definition = 'المعدات والادوات الصناعية' WHERE code = 31620;
UPDATE titres SET definition = 'الامتيازات و الحقوق و براءات الإختراع و التراخيص و ما يمثلها' WHERE code = 32200;


UPDATE `programme` SET `designation` = 'حشد الموارد المائية والآمن المائي' WHERE `programme`.`id` = 64;
UPDATE `programme` SET `designation` = 'حشد الموارد المائية التقليدية' WHERE `programme`.`id` = 307;
UPDATE `programme` SET `designation` = 'المياه غير التقليدية' WHERE `programme`.`id` = 308;
UPDATE `programme` SET `designation` = 'التوصيل وشبكات التوزيع بالمياه الصالحة للشرب والمياه الصناعية' WHERE `programme`.`id` = 311;
UPDATE `programme` SET `designation` = 'شبكة الصرف الصحي و أنظمة التطهير' WHERE `programme`.`id` = 315;
UPDATE `programme` SET `designation` = 'حماية المدن من الفيضانات' WHERE `programme`.`id` = 316;

