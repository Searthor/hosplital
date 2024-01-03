let jsonArray = [
    {
        id: 1,
        title: "ບໍລິການເງິນກູ້",
        img:'https://images.unsplash.com/photo-1701542183610-60708f7db8f7?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D',
        body: `It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).`
      },
  ];
const urlParams = new URLSearchParams(window.location.search);
const idUrl = urlParams.get('id');
console.log(idUrl);
const title = document.getElementById('title');

const detail = document.getElementById('Details');
const image = document.getElementById('image');
  for (let i = 0; i < jsonArray.length; i++) {
    if (jsonArray[i].id == urlParams.get('id')) {
      image.src=jsonArray[i].img;
      title.innerHTML=jsonArray[i].title;
      detail.innerHTML=jsonArray[i].body;
    }
  }
