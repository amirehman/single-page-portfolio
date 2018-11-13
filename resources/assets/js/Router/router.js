import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)


import Login from '../components/Auth/Login'
import Logout from '../components/Auth/Logout'
import Dashboard from '../components/Dashboard'
import AllProjects from '../components/backend/Projects/AllProjects'
import SingleProject from '../components/backend/Projects/single'
import ProjectCreate from '../components/backend/Projects/create'
import Elements from '../components/backend/Elements/Elements'
import AddPage from '../components/backend/Projects/Pages/create'
import singlePage from '../components/backend/Projects/Pages/single'
import Experties from '../components/backend/Experties/index'
import AllExperiences from '../components/backend/Experience/index'
import CreateExperience from '../components/backend/Experience/create'
import SingleExperience from '../components/backend/Experience/single'
import Education from '../components/backend/Education/Education'
import About from '../components/backend/About/about'
import General from '../components/backend/General/general'

//Frontend Components

import Home from '../components/frontend/Home'
import Work from '../components/frontend/Work'
import SingleWork from '../components/frontend/SingleWork'
import FrontAbout from '../components/frontend/About'
import Contacts from '../components/frontend/Contact.vue'



const routes = [
  { 
    path: '/me/login', 
    component: Login,
    name: 'login'
  },
  { 
    path: '/me/dashboard', 
    component: Dashboard,
    name: 'dashboard'
  },
  { 
    path: '/me/logout', 
    component: Logout,
    name: 'logout'
  },
  { 
    path: '/me/projects', 
    component: AllProjects,
    name: 'allprojects'
  },
  { 
    path: '/me/project/:slug', 
    component: SingleProject,
    name: 'singleproject'
  },
  { 
    path: '/me/projects/new', 
    component: ProjectCreate,
    name: 'projectcreate'
  },
  { 
    path: '/me/elements', 
    component: Elements,
    name: 'elements'
  },
  { // Add Pages to Project
    path: '/me/project/:id/add-page', 
    component: AddPage,
    name: 'addpage'
  },
  { // single project page
    path: '/me/project/:projectid/page/:pageid', 
    component: singlePage,
    name: 'singlepage'
  },
  { // Experties
    path: '/me/experties', 
    component: Experties,
    name: 'experties'
  },
  { // All Experience
    path: '/me/experiences', 
    component: AllExperiences,
    name: 'allexperiences'
  },
  { // Create Experience
    path: '/me/experience/create', 
    component: CreateExperience,
    name: 'createexperience'
  },
  { // Single Experience
    path: '/me/experience/:id', 
    component: SingleExperience,
    name: 'singleexperience'
  },
  { // Education
    path: '/me/education', 
    component: Education,
    name: 'education'
  },
  { // About
    path: '/me/about', 
    component: About,
    name: 'about'
  },
  { // General
    path: '/me/general', 
    component: General,
    name: 'general'
  }, // Frontend Routes Started // Home Route
  {
    path: '/', 
    component: Home,
    name: 'home'
  },
  {//Projects
    path: '/work', 
    component: Work,
    name: 'work'
  },
  { //Single Work
    path: '/work/:slug', 
    component: SingleWork,
    name: 'singlework'
  },
  { // About
    path: '/about', 
    component: FrontAbout,
    name: 'frontabout'
  },
  { // About
    path: '/contact', 
    component: Contacts,
    name: 'contact'
  },



  { path: "*", component: Home }
]

const router = new VueRouter({
  scrollBehavior() {
    return { x: 0, y: 0 };
  },
  hashbang: false,
  mode: 'history',
  routes 
})




export default router