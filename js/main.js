// ----- ДАННЫЕ ХОРЕОГРАФОВ (по одному на каждый стиль) -----
const choreographers = [
    { 
        name: 'Алексей Иванов', 
        style: 'Хип-Хоп', 
        desc: 'Уличный танцор с 10-летним стажем',
        photo: 'images/man1.jpg'
    },
    { 
        name: 'Екатерина Смирнова', 
        style: 'Хай Хилс', 
        desc: 'Создательница школы хай хилс в Москве',
        photo: 'images/woman1.jpg'
    },
    { 
        name: 'Дмитрий Новиков', 
        style: 'Стретчинг', 
        desc: 'Мастер по растяжке и йоге',
        photo: 'images/man2.jpg'
    },
    { 
        name: 'Анна Морозова', 
        style: 'Фрейм Ап', 
        desc: 'Режиссёр и хореограф, работала с клипами',
        photo: 'images/woman2.jpg'
    },
    { 
        name: 'Виктория Лебедева', 
        style: 'Вог', 
        desc: 'Победительница балов вог в Москве',
        photo: 'images/woman3.jpg'
    },
    { 
        name: 'Татьяна Осипова', 
        style: 'Афро', 
        desc: 'Изучала афро-танцы в Сенегале',
        photo: 'images/woman4.jpg'
    },
    { 
        name: 'Ирина Фролова', 
        style: 'Джаз Фанк', 
        desc: 'Хореограф с 8-летним опытом',
        photo: 'images/woman5.jpg'
    },
    { 
        name: 'Наталья Громова', 
        style: 'Денс-Холл', 
        desc: 'Популяризатор денс-холла в России',
        photo: 'images/woman6.jpg'
    }
];

// ----- ОТОБРАЖЕНИЕ ХОРЕОГРАФОВ -----
function renderChoreographers() {
    const container = document.getElementById('choreographers-list');
    if (!container) return;
    
    container.innerHTML = '';
    
    choreographers.forEach(c => {
        const card = document.createElement('div');
        card.className = 'choreographer-card';
        card.innerHTML = `
            <div class="avatar">
                ${c.photo ? `<img src="${c.photo}" alt="${c.name}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">` 
                           : `<i class="fas fa-user"></i>`}
            </div>
            <div class="info">
                <h5>${c.name}</h5>
                <div class="style-tag">${c.style}</div>
                <p>${c.desc}</p>
            </div>
        `;
        container.appendChild(card);
    });
}

// ----- АВТОМАТИЧЕСКИЙ ГОД В ПОДВАЛЕ -----
document.addEventListener('DOMContentLoaded', function() {
    const yearSpan = document.getElementById('currentYear');
    if (yearSpan) {
        yearSpan.textContent = new Date().getFullYear();
    }
    renderChoreographers();
});