// toggle-switch dark mode and light mode

document.addEventListener("DOMContentLoaded", function () {
    // เรียกใช้งานโค้ดที่เกี่ยวกับ Dark Mode หลังจาก DOM ได้โหลดเสร็จแล้ว
    // สร้างตัวแปร isDarkMode เพื่อเก็บสถานะของ Dark Mode
    let isDarkMode = false;

    // หากมีการกำหนดค่า DarkModeState ใน localStorage ให้ใช้ค่านั้นเป็นค่าเริ่มต้น
    if (localStorage.getItem('DarkModeState')) {
        isDarkMode = localStorage.getItem('DarkModeState') === 'true';
    }

    // เลือก div ที่มีคลาส toggle-switch
    const toggleSwitch = document.querySelectorAll('.toggle-switch');
    toggleSwitch.forEach(function (toggleSwitch) {
        // เพิ่ม Event Listener สำหรับคลิก
        toggleSwitch.addEventListener('click', function () {
            // สลับค่า isDarkMode ระหว่าง true และ false
            isDarkMode = !isDarkMode;
            // บันทึกค่า isDarkMode ลงใน localStorage
            localStorage.setItem('DarkModeState', isDarkMode.toString());

            // อัพเดทข้อความและสถานะของ dark mode ตามค่า isDarkMode ที่เปลี่ยนแปลง
            updateDarkMode(isDarkMode);
            updateImageVisibility();
        });
    });

    // อัพเดทข้อความและสถานะของ dark mode ตามค่า isDarkMode
    function updateDarkMode(isDarkMode) {
        var modeTextElement = document.body.querySelector(".mode-text");
        modeTextElement.innerText = isDarkMode ? "Dark Mode" : "Light Mode";

        // สลับคลาส 'dark' ใน body ตามค่า isDarkMode
        document.body.classList.toggle('dark', isDarkMode);
    }
    // ฟังก์ชันเพื่ออัปเดตการแสดงผลของภาพตามค่า isDarkMode
    function updateImageVisibility() {
        // อ่านค่า isDarkMode จาก localStorage
        let isDarkMode = localStorage.getItem('DarkModeState') === 'true';

        // เลือกทุก element ที่มีคลาส .image
        const imageElements = document.querySelectorAll(".image");
        imageElements.forEach(function (imageElement) {
            const lightImage = imageElement.querySelector(".light");
            const darkImage = imageElement.querySelector(".dark");

            lightImage.style.display = isDarkMode ? 'none' : 'inline-block';
            darkImage.style.display = isDarkMode ? 'inline-block' : 'none';
        });
    }
    // เรียกใช้งานฟังก์ชัน updateDarkMode เพื่อตั้งค่าเริ่มต้นสำหรับ Dark Mode
    updateDarkMode(isDarkMode);
    updateImageVisibility();
});


// sidebar-responsive and overlay page add window.interWidth > 1060

document.addEventListener("DOMContentLoaded", function () {
    // สร้างตัวแปร showSidebar เพื่อเก็บสถานะของ sidebar
    let showSidebar = false;
    // เลือกองค์ประกอบ sidebar และ overlay background
    const sidebarResponsive = document.querySelector(".sidebar-responsive");
    const overlayBackground = document.querySelector(".overlay");
    // เพิ่ม Event Listener สำหรับคลิกที่ปุ่มหรือสิ่งอื่น ๆ เพื่อเปิดหรือปิด sidebar
    document.getElementById('showsidebar-toggle').addEventListener('click', function () {
        // สลับค่า showSidebar ระหว่าง true และ false
        showSidebar = !showSidebar;
        // อัปเดตการแสดงผลของ sidebar และ overlay background
        ShowSidebar();
    });
    function ShowSidebar() {
        if (showSidebar) {
            sidebarResponsive.classList.add("show");
            overlayBackground.style.display = "block";
        } else {
            sidebarResponsive.classList.remove("show");
            overlayBackground.style.display = "none";
        }
    }

    function handleClickOutside(event) {
        if (!sidebarResponsive.contains(event.target)) {
            showSidebar = false;
        }
        ShowSidebar();

    }
    document.addEventListener('mousedown', handleClickOutside);
    // เพิ่ม Event Listener สำหรับตรวจสอบขนาดหน้าจอเพื่อปิด sidebar โดยใช้ JavaScript
    window.addEventListener('resize', function () {
        // ตรวจสอบขนาดหน้าจอเมื่อ resize และปิด sidebar ถ้าขนาดหน้าจอเล็กกว่า 1060px
        if (window.innerWidth > 1060 || window.innerWidth < 280) {
            showSidebar = false;
            ShowSidebar();
        }
    });

});

// nav-tabs in camera.php add class active when click in nav-tabs

document.addEventListener("DOMContentLoaded", function () {

    // รับ Element ของเมนูทั้งหมด
    document.querySelectorAll('.nav-link').forEach(button => {
        button.addEventListener('click', function () {
            // Remove 'active' class from all buttons
            document.querySelectorAll('.nav-link').forEach(btn => {
                btn.classList.remove('active');
            });

            // Add 'active' class to the clicked button
            this.classList.add('active');
        });
    });
});

// หากคลิกที่ tab ให้เปลี่ยน tab-pane ที่เกี่ยวข้อง
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function (tab) {
        tab.addEventListener('click', function (event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่
            var target = document.querySelector(tab.getAttribute('data-bs-target'));
            if (!target.classList.contains('active')) {
                document.querySelectorAll('.tab-pane').forEach(function (tabPane) {
                    tabPane.classList.remove('active');
                });
                target.classList.add('active');
            }
        });
    });

});