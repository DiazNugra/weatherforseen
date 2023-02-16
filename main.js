const cariKota = () => {

        const status = document.querySelector('.status');

        const success = (position) =>{
                console.log(position)
                const latitude = position.coords.latitude;
                const longitude = position.coords.longitude;
                
                const geoApiLink = 'https://api.bigdatacloud.net/data/reverse-geocode-client?latitude=${latitude}&longitude=${longitude}&localityLanguage=id'

                fetch(geoApiLink)
                .then(res => res.json())
                .then(data => {
                    // status.textContent = data.principalSubdivision
                    console.log(data)
                })
        }

        const error = () => {
            status.textContent = 'Tidak Dapat Menemukan Lokasi';
        }

        navigator.geolocation.getCurrentPosition(success, error);
}

document.querySelector('.cari-kota').addEventListener('click', cariKota);