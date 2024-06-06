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

// Active Menu Link based on Current URL Path in responsive-sidebar and sidebar
const namepath = ['dashboard', 'building', 'camera', 'classroom', 'subject', 'queue'];
const currentPath = window.location.pathname.toLowerCase();

const menuLinks = document.querySelectorAll('.menu-bar-link');

let matchedIndex = -1;

for (let i = 0; i < namepath.length; i++) {
  const pathWithSlash = `/${namepath[i].toLowerCase()}`;
  if (currentPath.includes(pathWithSlash)) {
    matchedIndex = i;
    break; // เลือก index แรกที่ตรงและหยุดวนลูป
  }
}

menuLinks.forEach((link, index) => {
  const linkPath = link.querySelector('a').getAttribute('href').toLowerCase();
  const pathWithSlash = `/${namepath[matchedIndex].toLowerCase()}`;

  if (linkPath.includes(pathWithSlash)) {
    link.classList.add('active');
  } else {
    link.classList.remove('active');
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

    document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function(tab) {
        tab.addEventListener('click', function(event) {
            event.preventDefault(); // ป้องกันการโหลดหน้าใหม่
            // หา target tab-pane ที่เกี่ยวข้องกับแท็บที่ถูกคลิก
            var targetId = tab.getAttribute('data-bs-target');
            var targetTabPane = document.querySelector(targetId);

            // ตรวจสอบว่า tab-pane นี้ไม่ได้เป็น 'show active' แล้วเท่านั้นที่จะดำเนินการ
            if (!targetTabPane.classList.contains('show') && !targetTabPane.classList.contains('active')) {
                // ลบคลาส 'active' ออกจาก tab-pane ที่มีอยู่ทั้งหมด
                document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
                    tabPane.classList.remove('active', 'show');
                });
                // เพิ่มคลาส 'show active' ให้กับ target tab-pane
                // targetTabPane.classList.add('active', 'show');
                targetTabPane.classList.add('active');
                setTimeout(function() {
                    targetTabPane.classList.add('show');
                }, 50); 
            }
        });
    });

});

// Remove class show of spinner
document.addEventListener("DOMContentLoaded", function () {
   // Spinner
    var spinner = function () {
    setTimeout(function () {
      var spinnerElement = document.getElementById('spinner');
      if (spinnerElement !== null) {
        spinnerElement.classList.remove('show');
      }
    }, 1);
  };
  
  spinner();
});
// show of Modal
document.addEventListener("DOMContentLoaded", function () {
  // Function to initialize all modals
  function initializeModals() {
      // Select all modals and buttons
      var modals = document.querySelectorAll(".modal");
      var modalButtons = document.querySelectorAll("[data-bs-toggle='modal']");

      modalButtons.forEach(function (btn) {
          // Get the target modal ID from the button's data-bs-target attribute
          var targetModalId = btn.getAttribute("data-bs-target").substring(1);
          console.log(targetModalId);
          var modal = document.getElementById(targetModalId);

          // Get the close buttons within the modal
          var closeModalBtns = modal.querySelectorAll("[data-bs-dismiss='modal']");

          // Show the modal when the button is clicked
          btn.addEventListener("click", function () {
              modal.style.display = "block";
              setTimeout(function () {
                  modal.classList.add("show");
              }, 10);
          });

          // Close the modal when any close button is clicked
          closeModalBtns.forEach(function (closeBtn) {
              closeBtn.addEventListener("click", function () {
                  modal.classList.remove("show");
                  setTimeout(function () {
                      modal.style.display = "none";
                  }, 150);
              });
          });

          // Prevent the modal from closing when clicking outside of it or pressing Escape
          modal.addEventListener("click", function (event) {
              if (event.target === modal) {
                  modal.classList.add("modal-static");
                  setTimeout(function () {
                      modal.classList.remove("modal-static");
                  }, 180);
              }
          });
      });
  }
  // Initialize all modals on the page
  initializeModals();
});

// remove class alert
// document.addEventListener("DOMContentLoaded", function () {

//  // Function to fade out alert messages
//    var fadeOutAlerts = function () {
//     setTimeout(function () {
//         const alerts = document.querySelectorAll('.alert'); // Get all alert elements
//       if (alerts !== null) {
//         alerts.forEach(alert => {
//               alert.style.transition = 'opacity 0.5s ease-in-out'; // Set transition properties
//               alert.style.opacity = 0; // Gradually reduce opacity to 0
      
//             // Remove the alert element after the transition is complete
//             alert.addEventListener('transitionend', () => {
//               alert.parentNode.removeChild(alert); // Remove from DOM
//             });
//           });
//       }
//     }, 5000);
//   };
//   fadeOutAlerts();
// });
  

// หากคลิกที่ tab ให้เปลี่ยน tab-pane ที่เกี่ยวข้อง

// document.addEventListener("DOMContentLoaded", function () {

//  // บันทึก scroll position เมื่อหน้าเว็บจะปิดหรือรีเฟรช
// window.addEventListener('beforeunload', function() {
//     const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
//     localStorage.setItem('scrollPosition', scrollPosition);
//   });
  
//   // คืนค่า scroll position เมื่อหน้าเว็บโหลดเสร็จ
//   window.addEventListener('load', function() {
//     const savedScrollPosition = localStorage.getItem('scrollPosition');
//     if (savedScrollPosition) {
//       window.scrollTo(0, savedScrollPosition);
//       localStorage.removeItem('scrollPosition'); // ลบค่าออกจาก localStorage เมื่อใช้งานแล้ว
//     }
//   });

// });