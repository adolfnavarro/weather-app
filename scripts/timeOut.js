

function refreshTimeOutPhotos(location) {
    debugger;
    document.querySelectorAll('.carousel-item').forEach((element) => {
        element.remove()
    })

    console.log(`Downloading photos from ...${location.name}`)

    const formData = new FormData();
    formData.append('getTimeOutPhoto', true);
    formData.append('location', location.name);
    formData.append('temperature',document.temperature);
    formData.append('weatherCode',document.weatherCode)
    const options = {
        method: 'POST',
        body: formData
    };

    fetch("./timeOut.php", options)
        .then((response)=>{return response.json()})
        .then((data) => {
            debugger;
     
            console.log(data);

                let photo = document.createElement('img')
                document.querySelector('#imgTimeOut').src = data['imageUrl'];
                document.querySelector('#titleTimeOut').innerHTML = data['imageTitle'];
                document.querySelector('#imgDesc').innerHTML = data['imageDesc'];
                document.querySelector('#botonTimeOut').href = data['butonHref'];
                document.querySelector('#botonTimeOut').innerHTML = data['butonText'];
                photo.classList.add('d-block', 'w-100', 'border', 'border-3', 'border-danger-subtle', 'rounded-4')
                let carouselItem = document.createElement('div')
                carouselItem.classList.add('carousel-item')
                carouselItem.append(photo)
                document.querySelector('#carouselTimeOut div.carousel-inner').append(carouselItem)
                document.querySelector('.carousel-item').classList.add('active')
                
        })
        .catch((error) => { console.log(error) })
}

export { refreshTimeOutPhotos }