document.addEventListener('DOMContentLoaded', function () {
  const serviceDropdown = document.getElementById('service');
  const doctorDropdown = document.getElementById('doctor');
  const form = document.getElementById('appointmentForm');
  const successMessage = document.getElementById('successMessage');

  // Fetch daftar layanan dari database
  function fetchServices() {
    fetch('fetch_services.php') // Ganti dengan endpoint API yang sesuai
      .then(response => response.json())
      .then(data => {
        console.log('Respons dari server untuk layanan:', data); // Log respons untuk debugging
        if (data.status === 'success') {
          serviceDropdown.innerHTML = '<option value="">Pilih layanan</option>';
          data.service.forEach(services => {
            const option = document.createElement('option');
            option.value = service.id; // ID layanan dari database
            option.textContent = service.name; // Nama layanan dari database
            serviceDropdown.appendChild(option);
          });
        } else {
          alert('Gagal memuat daftar layanan.');
        }
      })
      .catch(error => console.error('Error fetching services:', error));
  }

  // Fetch daftar dokter berdasarkan layanan
  function fetchDoctors(serviceId) {
    fetch(`fetch_doctors.php?service_id=${serviceId}`) // Ganti dengan endpoint API yang sesuai
      .then(response => response.json())
      .then(data => {
        console.log('Respons dokter:', data); // Log respons untuk debugging
        if (data.status === 'success') {
          doctorDropdown.innerHTML = '<option value="">Pilih dokter</option>';
          data.doctors.forEach(doctor => {
            const option = document.createElement('option');
            option.value = doctor.id; // ID dokter dari database
            option.textContent = `${doctor.name} - ${doctor.specialty}`;
            doctorDropdown.appendChild(option);
          });
        } else {
          doctorDropdown.innerHTML = '<option value="">Tidak ada dokter tersedia</option>';
        }
      })
      .catch(error => console.error('Error fetching doctors:', error));
  }

  // Event listener untuk perubahan pilihan layanan
  serviceDropdown.addEventListener('change', function () {
    const selectedServiceId = serviceDropdown.value;
    console.log('Layanan yang dipilih:', selectedServiceId); // Debugging
    if (selectedServiceId) {
      fetchDoctors(selectedServiceId);
    } else {
      doctorDropdown.innerHTML = '<option value="">Pilih layanan terlebih dahulu</option>';
    }
  });

  // Event listener untuk submit form
  form.addEventListener('submit', function (event) {
    event.preventDefault(); // Mencegah form mengirimkan data secara langsung

    const formData = new FormData(form);
    const userId = sessionStorage.getItem('user_id'); // Mengambil ID user dari session
    const userName = sessionStorage.getItem('user_name'); // Mengambil nama user dari session

    if (userId && userName) {
      formData.append('user_id', userId);
      formData.set('name', userName); // Menggunakan nama dari session untuk patient_name
    }

    // Kirim data form ke server menggunakan fetch
    fetch('appointment.php', {
      method: 'POST',
      body: formData
    })
      .then(response => response.json())
      .then(data => {
        if (data.status === 'success') {
          // Menampilkan pesan sukses
          successMessage.style.display = 'block';
          successMessage.textContent = data.message;

          // Mereset form dan dropdown dokter
          form.reset();
          doctorDropdown.innerHTML = '<option value="">Pilih layanan terlebih dahulu</option>';
        } else {
          alert(data.message);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Terjadi kesalahan saat memproses data. Silakan coba lagi.');
      });
  });

  // Memuat daftar layanan saat halaman selesai dimuat
  fetchServices();
});
