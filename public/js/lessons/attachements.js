var section_id = window.location.href.split('/')[window.location.href.split('/').indexOf("section") + 1]
var lesson_id = window.location.href.split('/')[window.location.href.split('/').indexOf("lesson") + 1];

addEventListener("trix-attachment-add", function (event) {
    if (event.attachment.file) {
        uploadFileAttachment(event.attachment)
    }
})

addEventListener("trix-attachment-remove", function (event) {
    if (event.attachment.file) {
        deleteFileAttachment(event.attachment)
    }
})

function uploadFileAttachment(attachment) {
    uploadFile(attachment, setProgress, setAttributes)

    function setProgress(progress) {
        attachment.setUploadProgress(progress)
    }

    function setAttributes(attributes) {
        attachment.setAttributes(attributes)
    }
}

function uploadFile(attachment, progressCallback, successCallback) {
    var formData = createFormData(attachment.file);
    var xhr = new XMLHttpRequest();

    xhr.open("POST", "/upload", true);
    xhr.setRequestHeader('X-CSRF-TOKEN', getMeta('csrf-token'));

    xhr.upload.addEventListener("progress", function (event) {
        var progress = event.loaded / event.total * 100
        progressCallback(progress)
    })

    xhr.addEventListener("load", function (event) {
        var attributes = {
            url: JSON.parse(xhr.response).url,
            href: JSON.parse(xhr.response).href
        }
        successCallback(attributes)
    })

    xhr.send(formData)
}

function createFormData(file) {
    var data = new FormData()
    data.append("Content-Type", file.type)
    data.append("file", file)
    data.append("section_id", section_id)
    data.append("lesson_id", lesson_id)
    return data
}

function getMeta(metaName) {
    const metas = document.getElementsByTagName('meta');

    for (let i = 0; i < metas.length; i++) {
        if (metas[i].getAttribute('name') === metaName) {
            return metas[i].getAttribute('content');
        }
    }

    return '';
}