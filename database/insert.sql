-- Insert departments
INSERT INTO department (department_name) VALUES 
('แผนกวิชาคอมพิวเตอร์'),
('แผนกวิชาการบัญชี'),
('แผนกวิชาการตลาด'),
('แผนกวิชาวิศวกรรม'),
('แผนกวิชาภาษาอังกฤษ'),
('แผนกวิชาการโรงแรม'),
('แผนกวิชานิเทศศาสตร์'),
('แผนกวิชานิติศาสตร์'),
('แผนกวิชาการแพทย์');

-- Insert subjects for Computer Science department (department_id = 1)
INSERT INTO subject (subject_name, department_id) VALUES 
('การเขียนโปรแกรมเบื้องต้น', 1),
('ฐานข้อมูล', 1),
('การพัฒนาเว็บ', 1),
('เครือข่ายคอมพิวเตอร์', 1),
('ปัญญาประดิษฐ์', 1);

-- Insert sub-subjects for Computer Science subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('การเขียนโปรแกรมด้วย Python', 1),
('การเขียนโปรแกรมด้วย Java', 1),
('การเขียนโปรแกรมด้วย C++', 1),
('การเขียนโปรแกรมด้วย JavaScript', 1),
('การเขียนโปรแกรมด้วย PHP', 1),

('การออกแบบฐานข้อมูล', 2),
('การจัดการฐานข้อมูล', 2),
('การใช้ SQL', 2),
('การใช้ NoSQL', 2),
('การใช้ฐานข้อมูลเชิงสัมพันธ์', 2),

('การพัฒนาเว็บด้วย HTML', 3),
('การพัฒนาเว็บด้วย CSS', 3),
('การพัฒนาเว็บด้วย JavaScript', 3),
('การพัฒนาเว็บด้วย PHP', 3),
('การพัฒนาเว็บด้วย React', 3),

('พื้นฐานเครือข่าย', 4),
('การติดตั้งเครือข่าย', 4),
('การจัดการเครือข่าย', 4),
('การรักษาความปลอดภัยเครือข่าย', 4),
('การออกแบบเครือข่าย', 4),

('พื้นฐานปัญญาประดิษฐ์', 5),
('การเรียนรู้ของเครื่อง', 5),
('การประมวลผลภาษาธรรมชาติ', 5),
('การรู้จำภาพ', 5),
('การวิเคราะห์ข้อมูลขนาดใหญ่', 5);

-- Insert subjects for Accounting department (department_id = 2)
INSERT INTO subject (subject_name, department_id) VALUES 
('บัญชีการเงิน', 2),
('บัญชีบริหาร', 2),
('ภาษีอากร', 2),
('การบัญชีต้นทุน', 2),
('การวิเคราะห์งบการเงิน', 2);

-- Insert sub-subjects for Accounting subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานบัญชีการเงิน', 6),
('การจัดทำงบการเงิน', 6),
('การวิเคราะห์งบการเงิน', 6),
('การบริหารเงินสด', 6),
('การจัดทำรายงานการเงิน', 6),

('พื้นฐานบัญชีบริหาร', 7),
('การจัดทำงบประมาณ', 7),
('การวิเคราะห์ต้นทุน', 7),
('การบริหารงบประมาณ', 7),
('การวางแผนและควบคุม', 7),

('พื้นฐานภาษีอากร', 8),
('การคำนวณภาษีเงินได้', 8),
('การคำนวณภาษีมูลค่าเพิ่ม', 8),
('การคำนวณภาษีธุรกิจ', 8),
('การจัดทำรายงานภาษี', 8),

('พื้นฐานการบัญชีต้นทุน', 9),
('การคำนวณต้นทุนสินค้า', 9),
('การจัดทำรายงานต้นทุน', 9),
('การวิเคราะห์ต้นทุนผลิต', 9),
('การจัดการต้นทุน', 9),

('การวิเคราะห์งบการเงิน', 10),
('การจัดทำรายงานวิเคราะห์', 10),
('การตรวจสอบงบการเงิน', 10),
('การประเมินสถานะการเงิน', 10),
('การบริหารงบการเงิน', 10);

-- Insert subjects for Marketing department (department_id = 3)
INSERT INTO subject (subject_name, department_id) VALUES 
('การตลาดเบื้องต้น', 3),
('การวิจัยตลาด', 3),
('การตลาดดิจิทัล', 3),
('การบริหารแบรนด์', 3),
('การจัดการการขาย', 3);

-- Insert sub-subjects for Marketing subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานการตลาด', 11),
('การวางแผนการตลาด', 11),
('การสร้างกลยุทธ์การตลาด', 11),
('การใช้เครื่องมือการตลาด', 11),
('การวิเคราะห์ตลาด', 11),

('พื้นฐานการวิจัยตลาด', 12),
('การเก็บข้อมูลตลาด', 12),
('การวิเคราะห์ข้อมูลตลาด', 12),
('การจัดทำรายงานวิจัยตลาด', 12),
('การใช้ข้อมูลวิจัยตลาด', 12),

('พื้นฐานการตลาดดิจิทัล', 13),
('การโฆษณาออนไลน์', 13),
('การตลาดบนโซเชียลมีเดีย', 13),
('การใช้ SEO และ SEM', 13),
('การวิเคราะห์ข้อมูลดิจิทัล', 13),

('พื้นฐานการบริหารแบรนด์', 14),
('การสร้างแบรนด์', 14),
('การจัดการแบรนด์', 14),
('การวิเคราะห์แบรนด์', 14),
('การตลาดแบรนด์', 14),

('พื้นฐานการจัดการการขาย', 15),
('การวางแผนการขาย', 15),
('การสร้างทีมขาย', 15),
('การจัดการลูกค้า', 15),
('การวิเคราะห์ยอดขาย', 15);


-- Insert subjects for Engineering department (department_id = 4)
INSERT INTO subject (subject_name, department_id) VALUES 
('วิศวกรรมเครื่องกล', 4),
('วิศวกรรมไฟฟ้า', 4),
('วิศวกรรมคอมพิวเตอร์', 4),
('วิศวกรรมโยธา', 4),
('วิศวกรรมเคมี', 4);

-- Insert sub-subjects for Engineering subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานเครื่องกล', 16),
('การออกแบบเครื่องกล', 16),
('การวิเคราะห์เครื่องกล', 16),
('การซ่อมบำรุงเครื่องกล', 16),
('การผลิตเครื่องกล', 16),

('พื้นฐานไฟฟ้า', 17),
('การออกแบบวงจรไฟฟ้า', 17),
('การติดตั้งระบบไฟฟ้า', 17),
('การซ่อมบำรุงระบบไฟฟ้า', 17),
('การจัดการพลังงานไฟฟ้า', 17),

('พื้นฐานคอมพิวเตอร์', 18),
('การเขียนโปรแกรมคอมพิวเตอร์', 18),
('การจัดการเครือข่าย', 18),
('การรักษาความปลอดภัยคอมพิวเตอร์', 18),
('การพัฒนาแอปพลิเคชัน', 18),

('พื้นฐานโยธา', 19),
('การออกแบบโครงสร้าง', 19),
('การวิเคราะห์โครงสร้าง', 19),
('การก่อสร้างและการจัดการโครงการ', 19),
('การซ่อมบำรุงโครงสร้าง', 19),

('พื้นฐานเคมี', 20),
('การวิเคราะห์เคมี', 20),
('การสังเคราะห์เคมี', 20),
('การประยุกต์ใช้เคมี', 20),
('การจัดการเคมีอันตราย', 20);

-- Insert subjects for English department (department_id = 5)
INSERT INTO subject (subject_name, department_id) VALUES 
('การฟังและพูดภาษาอังกฤษ', 5),
('การอ่านและเขียนภาษาอังกฤษ', 5),
('ไวยากรณ์ภาษาอังกฤษ', 5),
('การแปลภาษาอังกฤษ', 5),
('การสอนภาษาอังกฤษ', 5);

-- Insert sub-subjects for English subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('การฟังเบื้องต้น', 21),
('การพูดเบื้องต้น', 21),
('การฟังและพูดขั้นสูง', 21),
('การฟังและพูดเชิงวิชาการ', 21),
('การฟังและพูดเชิงธุรกิจ', 21),

('การอ่านเบื้องต้น', 22),
('การเขียนเบื้องต้น', 22),
('การอ่านและเขียนขั้นสูง', 22),
('การอ่านและเขียนเชิงวิชาการ', 22),
('การอ่านและเขียนเชิงธุรกิจ', 22),

('ไวยากรณ์เบื้องต้น', 23),
('ไวยากรณ์ขั้นสูง', 23),
('การวิเคราะห์ไวยากรณ์', 23),
('การประยุกต์ใช้ไวยากรณ์', 23),
('ไวยากรณ์เชิงวิชาการ', 23),

('การแปลเบื้องต้น', 24),
('การแปลขั้นสูง', 24),
('การแปลเอกสาร', 24),
('การแปลวรรณกรรม', 24),
('การแปลเชิงวิชาการ', 24),

('การสอนเบื้องต้น', 25),
('การสอนขั้นสูง', 25),
('การพัฒนาหลักสูตร', 25),
('การวัดและประเมินผล', 25),
('การจัดการชั้นเรียน', 25);

-- Insert subjects for Hotel Management department (department_id = 6)
INSERT INTO subject (subject_name, department_id) VALUES 
('การจัดการโรงแรมเบื้องต้น', 6),
('การบริหารจัดการห้องพัก', 6),
('การบริหารจัดการอาหารและเครื่องดื่ม', 6),
('การตลาดและการขายโรงแรม', 6),
('การบริหารจัดการกิจกรรมและงานอีเวนต์', 6);

-- Insert sub-subjects for Hotel Management subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานการจัดการโรงแรม', 26),
('การบริการลูกค้า', 26),
('การจัดการคุณภาพ', 26),
('การจัดการทรัพยากรบุคคล', 26),
('การจัดการการเงินโรงแรม', 26),

('การจัดการห้องพักเบื้องต้น', 27),
('การบริการห้องพัก', 27),
('การจัดการอุปกรณ์และสิ่งอำนวยความสะดวก', 27),
('การทำความสะอาดและบำรุงรักษาห้องพัก', 27),
('การจัดการความปลอดภัยในห้องพัก', 27),

('การจัดการอาหารและเครื่องดื่มเบื้องต้น', 28),
('การบริการอาหารและเครื่องดื่ม', 28),
('การจัดการเมนู', 28),
('การจัดการครัว', 28),
('การควบคุมคุณภาพอาหารและเครื่องดื่ม', 28),

('การตลาดโรงแรมเบื้องต้น', 29),
('การขายโรงแรม', 29),
('การสร้างแคมเปญการตลาด', 29),
('การจัดการโปรโมชั่น', 29),
('การวิเคราะห์ตลาดโรงแรม', 29),

('การจัดการกิจกรรมและอีเวนต์เบื้องต้น', 30),
('การวางแผนกิจกรรม', 30),
('การจัดการงานอีเวนต์', 30),
('การประเมินผลกิจกรรม', 30),
('การจัดการทรัพยากรในงานอีเวนต์', 30);

-- Insert subjects for Mass Communication department (department_id = 7)
INSERT INTO subject (subject_name, department_id) VALUES 
('การสื่อสารมวลชนเบื้องต้น', 7),
('การสื่อสารมวลชนดิจิทัล', 7),
('การผลิตรายการโทรทัศน์', 7),
('การเขียนข่าวและบทความ', 7),
('การประชาสัมพันธ์และโฆษณา', 7);

-- Insert sub-subjects for Mass Communication subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานการสื่อสารมวลชน', 31),
('ทฤษฎีการสื่อสาร', 31),
('การวิจัยการสื่อสาร', 31),
('การวิเคราะห์เนื้อหา', 31),
('จริยธรรมการสื่อสาร', 31),

('การสื่อสารดิจิทัลเบื้องต้น', 32),
('การผลิตสื่อดิจิทัล', 32),
('การตลาดดิจิทัล', 32),
('การสื่อสารผ่านโซเชียลมีเดีย', 32),
('การวิเคราะห์ข้อมูลดิจิทัล', 32),

('การผลิตรายการโทรทัศน์เบื้องต้น', 33),
('การเขียนบทโทรทัศน์', 33),
('การจัดการการผลิต', 33),
('การตัดต่อวิดีโอ', 33),
('การจัดการเสียง', 33),

('การเขียนข่าวเบื้องต้น', 34),
('การเขียนบทความ', 34),
('การสัมภาษณ์และการรายงาน', 34),
('การตรวจสอบข้อเท็จจริง', 34),
('การจัดการข้อมูลข่าวสาร', 34),

('การประชาสัมพันธ์เบื้องต้น', 35),
('การสร้างภาพลักษณ์องค์กร', 35),
('การจัดการวิกฤต', 35),
('การเขียนสื่อประชาสัมพันธ์', 35),
('การสร้างแคมเปญโฆษณา', 35);

-- Insert subjects for Law department (department_id = 8)
INSERT INTO subject (subject_name, department_id) VALUES 
('กฎหมายแพ่งและพาณิชย์', 8),
('กฎหมายอาญา', 8),
('กฎหมายรัฐธรรมนูญ', 8),
('กฎหมายแรงงาน', 8),
('กฎหมายระหว่างประเทศ', 8);

-- Insert sub-subjects for Law subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานกฎหมายแพ่ง', 36),
('การวิเคราะห์คดีแพ่ง', 36),
('การเขียนสัญญา', 36),
('การจัดการข้อพิพาทแพ่ง', 36),
('กฎหมายทรัพย์สิน', 36),

('พื้นฐานกฎหมายอาญา', 37),
('การวิเคราะห์คดีอาญา', 37),
('การสืบสวนและการจับกุม', 37),
('การจัดการข้อพิพาทอาญา', 37),
('การดำเนินคดีอาญา', 37),

('พื้นฐานกฎหมายรัฐธรรมนูญ', 38),
('การตีความรัฐธรรมนูญ', 38),
('การวิเคราะห์ปัญหากฎหมายรัฐธรรมนูญ', 38),
('การจัดการข้อพิพาทรัฐธรรมนูญ', 38),
('กฎหมายสิทธิมนุษยชน', 38),

('พื้นฐานกฎหมายแรงงาน', 39),
('การจัดการข้อพิพาทแรงงาน', 39),
('การจัดการสัญญาแรงงาน', 39),
('กฎหมายแรงงานระหว่างประเทศ', 39),
('การวิเคราะห์ปัญหาแรงงาน', 39),

('พื้นฐานกฎหมายระหว่างประเทศ', 40),
('การวิเคราะห์คดีระหว่างประเทศ', 40),
('กฎหมายระหว่างประเทศด้านการค้า', 40),
('กฎหมายระหว่างประเทศด้านสิทธิมนุษยชน', 40),
('การจัดการข้อพิพาทระหว่างประเทศ', 40);

-- Insert subjects for Medical department (department_id = 9)
INSERT INTO subject (subject_name, department_id) VALUES 
('กายวิภาคศาสตร์', 9),
('จุลชีววิทยา', 9),
('สรีรวิทยา', 9),
('พยาธิวิทยา', 9),
('เภสัชวิทยา', 9);

-- Insert sub-subjects for Medical subjects
INSERT INTO sub_subject (sub_subject_name, subject_id) VALUES 
('พื้นฐานกายวิภาคศาสตร์', 41),
('กายวิภาคระบบประสาท', 41),
('กายวิภาคระบบหายใจ', 41),
('กายวิภาคระบบย่อยอาหาร', 41),
('กายวิภาคระบบสืบพันธุ์', 41),

('พื้นฐานจุลชีววิทยา', 42),
('จุลชีววิทยาเชิงคลินิก', 42),
('การวิเคราะห์ตัวอย่างจุลชีววิทยา', 42),
('การจัดการห้องปฏิบัติการจุลชีววิทยา', 42),
('การป้องกันและควบคุมการติดเชื้อ', 42),

('พื้นฐานสรีรวิทยา', 43),
('สรีรวิทยาการทำงานของระบบประสาท', 43),
('สรีรวิทยาการทำงานของระบบหัวใจและหลอดเลือด', 43),
('สรีรวิทยาการทำงานของระบบหายใจ', 43),
('สรีรวิทยาการทำงานของระบบย่อยอาหาร', 43),

('พื้นฐานพยาธิวิทยา', 44),
('พยาธิวิทยาเชิงคลินิก', 44),
('การวิเคราะห์ตัวอย่างพยาธิวิทยา', 44),
('การจัดการห้องปฏิบัติการพยาธิวิทยา', 44),
('การตรวจโรคและการวินิจฉัย', 44),

('พื้นฐานเภสัชวิทยา', 45),
('เภสัชวิทยาทางคลินิก', 45),
('การพัฒนาและการผลิตยา', 45),
('การวิเคราะห์ยา', 45),
('การจัดการการใช้ยา', 45);


-- Insert buildings for each department
INSERT INTO building (building_fullname, building_name) VALUES
('อาคารคณะวิชาคอมพิวเตอร์', 'ตึกคอมพิวเตอร์'),
('อาคารคณะวิชาการบัญชี', 'ตึกการบัญชี'),
('อาคารคณะวิชาการตลาด', 'ตึกการตลาด'),
('อาคารคณะวิชาวิศวกรรม', 'ตึกวิศวกรรม'),
('อาคารคณะวิชาภาษาอังกฤษ', 'ตึกภาษาอังกฤษ'),
('อาคารคณะวิชาการโรงแรม', 'ตึกการโรงแรม'),
('อาคารคณะวิชานิเทศศาสตร์', 'ตึกนิเทศศาสตร์'),
('อาคารคณะวิชานิติศาสตร์', 'ตึกนิติศาสตร์'),
('อาคารคณะวิชาการแพทย์', 'ตึกการแพทย์');

-- Insert rooms for Computer Science building (building_id = 1)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องคอมพิวเตอร์ 101', '101', 1),
('ห้องคอมพิวเตอร์ 102', '102', 1),
('ห้องคอมพิวเตอร์ 103', '103', 1),
('ห้องคอมพิวเตอร์ 104', '104', 1),
('ห้องคอมพิวเตอร์ 105', '105', 1);

-- Insert rooms for Accounting building (building_id = 2)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องบัญชี 201', '201', 2),
('ห้องบัญชี 202', '202', 2),
('ห้องบัญชี 203', '203', 2),
('ห้องบัญชี 204', '204', 2),
('ห้องบัญชี 205', '205', 2);

-- Insert rooms for Marketing building (building_id = 3)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องการตลาด 301', '301', 3),
('ห้องการตลาด 302', '302', 3),
('ห้องการตลาด 303', '303', 3),
('ห้องการตลาด 304', '304', 3),
('ห้องการตลาด 305', '305', 3);

-- Insert rooms for Engineering building (building_id = 4)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องวิศวกรรม 401', '401', 4),
('ห้องวิศวกรรม 402', '402', 4),
('ห้องวิศวกรรม 403', '403', 4),
('ห้องวิศวกรรม 404', '404', 4),
('ห้องวิศวกรรม 405', '405', 4);

-- Insert rooms for English building (building_id = 5)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องภาษาอังกฤษ 501', '501', 5),
('ห้องภาษาอังกฤษ 502', '502', 5),
('ห้องภาษาอังกฤษ 503', '503', 5),
('ห้องภาษาอังกฤษ 504', '504', 5),
('ห้องภาษาอังกฤษ 505', '505', 5);

-- Insert rooms for Hotel Management building (building_id = 6)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องการโรงแรม 601', '601', 6),
('ห้องการโรงแรม 602', '602', 6),
('ห้องการโรงแรม 603', '603', 6),
('ห้องการโรงแรม 604', '604', 6),
('ห้องการโรงแรม 605', '605', 6);

-- Insert rooms for Mass Communication building (building_id = 7)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องนิเทศศาสตร์ 701', '701', 7),
('ห้องนิเทศศาสตร์ 702', '702', 7),
('ห้องนิเทศศาสตร์ 703', '703', 7),
('ห้องนิเทศศาสตร์ 704', '704', 7),
('ห้องนิเทศศาสตร์ 705', '705', 7);

-- Insert rooms for Law building (building_id = 8)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องนิติศาสตร์ 801', '801', 8),
('ห้องนิติศาสตร์ 802', '802', 8),
('ห้องนิติศาสตร์ 803', '803', 8),
('ห้องนิติศาสตร์ 804', '804', 8),
('ห้องนิติศาสตร์ 805', '805', 8);

-- Insert rooms for Medical building (building_id = 9)
INSERT INTO room (room_name, room_number, building_id) VALUES
('ห้องการแพทย์ 901', '901', 9),
('ห้องการแพทย์ 902', '902', 9),
('ห้องการแพทย์ 903', '903', 9),
('ห้องการแพทย์ 904', '904', 9),
('ห้องการแพทย์ 905', '905', 9);


-- Insert cameras for Computer Science building (building_id = 1)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องคอมพิวเตอร์ 1', 1, 1, 1),
('กล้องคอมพิวเตอร์ 2', 1, 1, 2),
('กล้องคอมพิวเตอร์ 3', 1, 1, 3);

-- Insert cameras for Accounting building (building_id = 2)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องบัญชี 1', 1, 2, 6),
('กล้องบัญชี 2', 1, 2, 7),
('กล้องบัญชี 3', 1, 2, 8);

-- Insert cameras for Marketing building (building_id = 3)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องการตลาด 1', 1, 3, 11),
('กล้องการตลาด 2', 1, 3, 12),
('กล้องการตลาด 3', 1, 3, 13);

-- Insert cameras for Engineering building (building_id = 4)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องวิศวกรรม 1', 1, 4, 16),
('กล้องวิศวกรรม 2', 1, 4, 17),
('กล้องวิศวกรรม 3', 1, 4, 18);

-- Insert cameras for English building (building_id = 5)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องภาษาอังกฤษ 1', 1, 5, 21),
('กล้องภาษาอังกฤษ 2', 1, 5, 22),
('กล้องภาษาอังกฤษ 3', 1, 5, 23);

-- Insert cameras for Hotel Management building (building_id = 6)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องการโรงแรม 1', 1, 6, 26),
('กล้องการโรงแรม 2', 1, 6, 27),
('กล้องการโรงแรม 3', 1, 6, 28);

-- Insert cameras for Mass Communication building (building_id = 7)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องนิเทศศาสตร์ 1', 1, 7, 31),
('กล้องนิเทศศาสตร์ 2', 1, 7, 32),
('กล้องนิเทศศาสตร์ 3', 1, 7, 33);

-- Insert cameras for Law building (building_id = 8)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องนิติศาสตร์ 1', 1, 8, 36),
('กล้องนิติศาสตร์ 2', 1, 8, 37),
('กล้องนิติศาสตร์ 3', 1, 8, 38);

-- Insert cameras for Medical building (building_id = 9)
INSERT INTO camera (camera_name, status, building_id, room_id) VALUES
('กล้องการแพทย์ 1', 1, 9, 41),
('กล้องการแพทย์ 2', 1, 9, 42),
('กล้องการแพทย์ 3', 1, 9, 43);
