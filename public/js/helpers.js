let emailIndex = 0

const confirmAction = (actionId,callback,text='Are you sure? This action cannot be undone') => {
  const v = confirm(text)

  if(v){
    typeof callback === 'function' && callback(actionId)
  }
}

const handleResponseError = (data) => {
  console.log('data in error')
  let errMessage = 'please try again'
  if(data.message === 'validation'){
   errMessage = 'All fields are required'
  }
  else if(data.message === 'invalid-session'){
    errMessage = 'There was an issue while processing your data. Please contact support'
   }
  else if(data.message === 'invalid-user'){
   errMessage = 'User invalid, please contact support'
  }
  else if(data.message === 'own'){
    errMessage = 'You cannot carry out this action'
   }
  else if(data.message === 'auth'){
    errMessage = 'You must be signed in to continue'
   }
   else if(data.message === 'has-pending-application'){
    errMessage = 'You have a school application currently pending!'
   }
   else if(data.message === 'is-past-deadline'){
    errMessage = 'Date selected has to be before the admission deadline'
   }
   else if(data.message === 'payment-failed'){
    errMessage = 'Payment failed'
   }

  alert(errMessage)
}

const fetchWithFormData = async (payload={url:'',method:'POST',fd:(new FormData())},successCallback,errorCallback) => {
  const url = payload.url
  const response =  await fetch(url, {
    method: payload.method,
    body: payload.fd
  })
  if(response.status === 200){
    const responseJSON = await response.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response.status}`}
   errorCallback(ret)
  }
}

const fetchWithJson = async (payload={url:'',method:'POST',data:[{key:'',value:''}]},successCallback,errorCallback) => {
  let response = null

  if(payload.method === 'GET'){
    let paramString = ``

    if(payload.data.length > 0){
       for(const d of payload.data){
         paramString += `&${d.key}=${d.value}`
       }
    }
    const url = `${payload.url}?${paramString}`
     response = await fetch(url, {
        method: "GET",
      })
  }
  else{
    const fd = new FormData()
   
    if(payload.data.length > 0){
      for(const d of payload.data){
        fd.append(`${d.key}`,d.value)
      }
    }
    
    response = await fetch(payload.url, {
        method: payload.method,
        body: fd
      })
  }

  if(response?.status === 200){
    const responseJSON = await response?.json()
     successCallback(responseJSON)
  }
  else{
   const ret = {status: 'error', message: `Request failed with status code: ${response?.status}`}
   errorCallback(ret)
  }
}


const login = async (fd,successCallback,errorCallback) => {
    const url = 'api/signin'
    await fetchWithFormData(
      {
        url,
        fd,
        method: 'POST',
      },
      successCallback,
      errorCallback
    )
   
}

const signup = async (fd,successCallback,errorCallback) => {
  const url = 'api/signup'

  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const schoolSignup = async (fd,successCallback,errorCallback) => {
  const url = 'api/school-signup'

  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const completeSchoolSignup = async (fd,successCallback,errorCallback) => {
  const url = 'api/set-password'
  
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const changePassword = async (fd,successCallback,errorCallback) => {
  const url = 'api/change-password'
  
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const rn = async (fd,successCallback,errorCallback) => {
  const url = 'api/read-notification'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const addPlugin = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-plugin'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removePlugin = async (id,successCallback,errorCallback) => {
  const url = `api/remove-plugin`

  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addFacility = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-facility'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeFacility = async (id,successCallback,errorCallback) => {
  const url = `api/remove-facility`

  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )

 
}

const addClub = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-club'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeClub = async (id,successCallback,errorCallback) => {
  const url = `api/remove-club`
  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const updateSchoolInfo = async (fd,successCallback,errorCallback) => {
  const url = 'api/usi'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const addSchoolClass = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-class'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeSchoolClass = async (id,successCallback,errorCallback) => {
   const url = `api/remove-school-class`
   await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addAdmissionSession = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-admission'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const updateAdmissionSession = async (fd,successCallback,errorCallback) => {
  const url = 'api/update-school-admission'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeAdmissionSession = async (id,successCallback,errorCallback) => {
  const url = `api/remove-school-admission`
  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addAdmissionForm = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-admission-form'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeAdmissionForm = async (id,successCallback,errorCallback) => {
  const url = `api/remove-admission-form`
  await fetchWithJson(
    {
       url,
       method: 'GET',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addFormSection = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-form-section'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const updateFormSection = async (fd,successCallback,errorCallback) => {
  const url = 'api/update-form-section'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeFormSection = async (id,successCallback,errorCallback) => {
  const url = 'api/remove-form-section'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
 
}

const addFormField = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-form-field'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const removeFormField = async (id,successCallback,errorCallback) => {
  const url = 'api/remove-form-field'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value:id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const updateAdmissionForm = async ({id='',status='pending'},successCallback,errorCallback) => {
  const url = 'api/uaf'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: id},
        {key: 'status',value: status},
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addSchoolFaq = async (fd,successCallback,errorCallback) => {
  const url = 'api/add-school-faq'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const updateSchoolFaq = async ({id='',question='',answer=''},successCallback,errorCallback) => {
  const url = 'api/school-faq'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: id},
        {key: 'question',value: question},
        {key: 'answer',value: answer}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const removeFaq = async (id='',successCallback,errorCallback) => {
  const url = 'api/remove-school-faq'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const bomb = (
  {
    ll=[],
    subject='',
    msg='',
  },
successCallback,
errorCallback
) => {
  let url = `api/send-email`

const to = ll[emailIndex],dt = new FormData()
dt.append('msg',msg)
dt.append('subject',subject)
dt.append('to',to)

$('#logs-loading').fadeIn()
$('#mailer-results').fadeIn()


$.ajax({ 
 type : 'POST',
 url  : url,
 data : dt,
 processData: false,
 contentType: false,
 beforeSend: () => {
  $("#logs-loading").html('<div class="alert alert-info" role="alert" style=" text-align: center;"><strong class="block" style="font-weight: bold;">  Processing <img src="images/loading.gif" class="img img-esponsive" style="width: 20px; height: 20px;"></strong></div>');

 },
 success : (response) => {
   $('#logs-loading').hide()
    let ret = JSON.parse(response)
   console.log({response})
    
   if(ret['status'] == "ok" || ret['status'] == "sent"){
     $('#mailer-results').append("<p class='text-success'>Email sent to " + to + "</p>")   
   }
   else{
     $('#mailer-results').append("<p class='text-danger'>An error occured sending to " + to + "</p>")
   }
   
   
   setTimeout(function(){
     //console.log("data sent: " + dt);
     ++emailIndex; 
      if(emailIndex < ll.length){
        bomb({ll,subject,msg})
      } 
      else{
        typeof successCallback === 'function' && successCallback()
      }
     },5000)
   
   },
   error: (err) => {
    typeof errorCallback === 'function' && errorCallback(err)
   }
 })
}

const updateApplication = async (xf,status='',successCallback,errorCallback) => {
  const url = 'api/school-application'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: xf},
        {key: 'status',value: status}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const updateSchoolProfile = async (fd,successCallback,errorCallback) => {
  const url = 'api/usp'
  await fetchWithFormData(
    {
      url,
      fd,
      method: 'POST',
    },
    successCallback,
    errorCallback
  )
 
}

const updateSchoolReview = async (xf,status='',successCallback,errorCallback) => {
  const url = `api/update-school-review`
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: xf},
        {key: 'status',value: status}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const removeSchoolReview = async (id='',successCallback,errorCallback) => {
  const url = 'api/remove-school-review'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: id}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const addSchoolReview = async (payload={xf:'',environment:'',service:'',price:'',comment:''},successCallback,errorCallback) => {
  const url = 'api/add-school-review'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf},
        {key: 'environment',value: payload.environment},
        {key: 'service',value: payload.service},
        {key: 'price',value: payload.price},
        {key: 'comment',value: payload.comment}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const contactSchool = async (payload={xf:'',contactName:'',contactEmail:'',contactMessage:''},successCallback,errorCallback) => {
  const url = 'api/contact-school'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf},
        {key: 'contactName',value: payload.contactName},
        {key: 'contactEmail',value: payload.contactEmail},
        {key: 'contactMessage',value: payload.contactMessage}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const bookmarkSchool = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/add-school-bookmark'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf}
      ],
    },
    successCallback,
    errorCallback
  )
 
 
}

const updateSchoolStatus = async (payload={xf:'',ss:''},successCallback,errorCallback) => {
  const url = 'api/update-school'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf},
        {key: 'ss',value: payload.ss}
      ],
    },
    successCallback,
    errorCallback
  )
 
 
}

const requestSchoolApplication = async (payload={xf:'',selectedAdmission:'',selectedDate:'',selectedTime:''},successCallback,errorCallback) => {
  const url = 'api/init-school-application'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf},
        {key: 'selectedAdmission',value: payload.selectedAdmission},
        {key: 'selectedDate',value: payload.selectedDate},
        {key: 'selectedTime',value: payload.selectedTime},
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const completeSchoolApplication = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/complete-school-application'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf}
      ],
    },
    successCallback,
    errorCallback
  )
 
}

const verifySchoolApplication = async (payload={xf:''},successCallback,errorCallback) => {
  const url = 'api/verify-school-application'
  await fetchWithJson(
    {
       url,
       method: 'POST',
       data: [
        {key: 'xf',value: payload.xf}
      ],
    },
    successCallback,
    errorCallback
  )
 
}
