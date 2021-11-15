const path = document.querySelectorAll('#path')

const submit_dob = document.getElementById('submit_dob')
const dob = document.getElementById('dob')
const learning_paths = document.getElementById('learning_paths')
const backToTop = document.getElementById('backToTop')

learning_paths.style.display = "none"

window.onscroll = () => {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        backToTop.style.display = "block";
    } else {
        backToTop.style.display = "none";
    }
}

backToTop.addEventListener('click', () => {
    window.scrollTo({ top: document.getElementById('navbar'), behavior: 'smooth' });
})

let ids = []
const links = document.getElementById('links').children

function linkEventListeners(id) {

    document.getElementById(id).addEventListener("click", () => {
        let scrollDiv = document.getElementById(id.split(' ')[1]).offsetTop;
        window.scrollTo({ top: scrollDiv, behavior: 'smooth' });
    })
}

for (let i = 0, len = links.length; i < len; i++) {
    linkEventListeners(links[i].children[0].id)
}

const sample_code_link = document.getElementById('sample_code_link')

const sample_code_links = [
    "https://learntocode.penroselearning.com/pencode/sample.html?lang=python&code=pystart_intermediate_numbers_1",
    "https://learntocode.penroselearning.com/pencode/sample.html?lang=python&code=pystart_intermediate_forloop_3"
]

for (let i = 0, len = sample_code_links.length; i < len; i++) {
    document.getElementById('sample_code_btns').innerHTML += `<button class="sample_code_btn" onclick="viewSample(${i})" id="sample_code${i}">Sample ${i + 1}</button>`
}

function viewSample(sampleLinkIndex) {
    sample_code_link.src = sample_code_links[sampleLinkIndex]
    window.scrollTo({ top: sample_code_link.offsetTop - 65, behavior: 'smooth' });
}

function scrollRight() {
    const testimonial_cards = document.getElementById('testimonial_cards')
    let testimonial_cards_scoll_left = testimonial_cards.scrollLeft;
    const testimonial_scroll_width = testimonial_cards.scrollWidth;

    testimonial_cards_scoll_left += 200;
    if (testimonial_cards_scoll_left >= testimonial_scroll_width) { testimonial_cards_scoll_left = testimonial_scroll_width; }
    testimonial_cards.scrollLeft = testimonial_cards_scoll_left;
}

function scrollTestimonialsLeft() {
    const testimonial_cards = document.getElementById('testimonial_cards')
    let testimonial_cards_scoll_left = testimonial_cards.scrollLeft;
    const testimonial_scroll_width = testimonial_cards.scrollWidth;

    testimonial_cards_scoll_left -= 200;
    if (testimonial_cards_scoll_left >= testimonial_scroll_width) { testimonial_cards_scoll_left = testimonial_scroll_width; }
    testimonial_cards.scrollLeft = testimonial_cards_scoll_left;
}

function student_scrollRight() {
    const testimonial_cards = document.getElementById('student_testimonial_cards')
    let testimonial_cards_scoll_left = testimonial_cards.scrollLeft;
    const testimonial_scroll_width = testimonial_cards.scrollWidth;

    testimonial_cards_scoll_left += 200;
    if (testimonial_cards_scoll_left >= testimonial_scroll_width) { testimonial_cards_scoll_left = testimonial_scroll_width; }
    testimonial_cards.scrollLeft = testimonial_cards_scoll_left;
}

function student_scrollTestimonialsLeft() {
    const testimonial_cards = document.getElementById('student_testimonial_cards')
    let testimonial_cards_scoll_left = testimonial_cards.scrollLeft;
    const testimonial_scroll_width = testimonial_cards.scrollWidth;

    testimonial_cards_scoll_left -= 200;
    if (testimonial_cards_scoll_left >= testimonial_scroll_width) { testimonial_cards_scoll_left = testimonial_scroll_width; }
    testimonial_cards.scrollLeft = testimonial_cards_scoll_left;
}

function viewAssignment(sampleLinkIndex) {
    sample_assignment_link.src = student_assignments[sampleLinkIndex]
    window.scrollTo({ top: sample_assignment_link.offsetTop, behavior: 'smooth' });
}

const sample_assignment_link = document.getElementById('sample_assignment_link')

const student_assignments = [
    "https://learntocode.penroselearning.com/pencode/sample.html?lang=python&code=pystart_intermediate_numbers_1",
    "https://learntocode.penroselearning.com/pencode/sample.html?lang=python&code=pystart_intermediate_forloop_3"
]

for (let i = 0, len = student_assignments.length; i < len; i++) {
    document.getElementById('sample_assignment_btns').innerHTML += `<button class="sample_code_btn" onclick="viewAssignment(${i})" id="sample_code${i}">Project ${i + 1}</button>`
}


function viewLearningPath(learning_path_name) {

    const complexity_main_container = document.getElementById("complexity_main_container")

    if (learning_path_name == 'age_7_or_below') {
        complexity_main_container.style.display = "none"
    } else {
        complexity_main_container.style.display = "flex"
    }

    document.getElementById(learning_path_name).style.display = "block"
    let scrollDiv = document.getElementById(learning_path_name).offsetTop;
    window.scrollTo({ top: scrollDiv, behavior: 'smooth' });
}

submit_dob.addEventListener("click", () => {

    learning_paths.style.display = "block"


    const age_7_or_below = document.getElementById('age_7_or_below')
    const age_8_to_10 = document.getElementById('age_8_to_10')
    const age_11_to_13 = document.getElementById('age_11_to_13')
    const age_14_and_above = document.getElementById('age_14_and_above')

    age_7_or_below.style.display = "none"
    age_8_to_10.style.display = "none"
    age_11_to_13.style.display = "none"
    age_14_and_above.style.display = "none"

    let today = new Date();
    let birthDate = new Date(dob.value);
    let current_age = today.getFullYear() - birthDate.getFullYear();
    let m = today.getMonth() - birthDate.getMonth();
    if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
        current_age--;
    }

    if (current_age < 8) {
        viewLearningPath('age_7_or_below')
    }
    else if (current_age >= 8 && current_age <= 10) {
        viewLearningPath('age_8_to_10')
    }
    else if (current_age >= 11 && current_age <= 13) {
        viewLearningPath('age_11_to_13')
    }
    else if (current_age >= 14) {
        viewLearningPath('age_14_and_above')
    }

})

for (path_info of path) {
    if (path_info.classList.contains('easy')) {
        path_info.style.backgroundColor = "#09ff00"
        path_info.style.color = "white"
    }
    else if (path_info.classList.contains('medium')) {
        path_info.style.backgroundColor = "#fdff08"
        path_info.style.color = "black"
    }
    else if (path_info.classList.contains('hard')) {
        path_info.style.backgroundColor = "#fe0000"
        path_info.style.color = "white"
    }
}
