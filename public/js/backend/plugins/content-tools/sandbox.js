(function() {
  var CloudinaryUploader;
  window.CloudName = 'dzctvmw1g';
  CloudinaryUploader = (function() {
    CloudinaryUploader.phpUrl = sandbox_url;
    CloudinaryUploader.selectedImage;

    function CloudinaryUploader(dialog) {
      this._dialog = dialog;
      this._dialog.addEventListener('cancel', (function(_this) {
        return function() {
          return _this._onCancel();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.clear', (function(_this) {
        return function() {
          return _this._onClear();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.fileready', (function(_this) {
        return function(ev) {
          return _this._onFileReady(ev._detail.detail);
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.gotoupload', (function(_this) {
        return function(ev) {
          return _this._goToUpload();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.getuploadedfile', (function(_this) {
        return function(ev) {
          return _this._getUploadedFile(ev.detail().file);
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.mount', (function(_this) {
        return function() {
          return _this._onMount();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.save', (function(_this) {
        return function() {
          return _this._onSave();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.unmount', (function(_this) {
        return function() {
          return _this._onUnmount();
        };
      })(this));
      this._dialog.addEventListener('cloudinarydialog.medialibrary', (function(_this) {
        return function() {
          return _this._onMediaLibrary();
        };
      })(this));
      this._dialog.addEventListener('cloudinaryimage.select', (function(_this) {
        return function() {
          return _this._onImageClick();
        };
      })(this));
    }

    CloudinaryUploader.prototype._onImageClick = function(imgDiv) {
      return this._dialog.state('empty');
    };

    CloudinaryUploader.prototype._onCancel = function() {};

    CloudinaryUploader.prototype._onSearch = function(searchText) {
      var clearBusy;
      this._dialog.busy(true);
      this.cloudinaryMediaLibrary.innerHTML = "";
      var images;
      var xhttp = new XMLHttpRequest();
      var __dialog = this._dialog;
      var cloudinaryMediaLibrary = this.cloudinaryMediaLibrary;
      var cloudinaryLoadMore = this.cloudinaryLoadMore;
      xhttp.onreadystatechange = function(res) {
        if (this.readyState == 4 && this.status == 200) {
          __dialog.busy(false)
          images = JSON.parse(res.target.response);
          if(images.next_cursor)
          {
            ContentEdit.removeCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
            cloudinaryLoadMore.setAttribute('data-nextcursor', images.next_cursor);
          }
          else
          {
            ContentEdit.addCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
          }
          if(typeof images.resources !== 'undefined' && images.resources.length > 0)
          {
            for (var i = images.resources.length - 1; i >= 0; i--) {
              var image_div = __dialog.constructor.createDiv(['ct-cloudinary-image-item']);
              image_div.setAttribute('data-resources', JSON.stringify(images.resources[i]));
              image_div.addEventListener('click', (function(_this) {
                return function() {
                  var prevSelectedImage = document.querySelectorAll(".ct-selected-cloudinary-image");
                  for (var i = prevSelectedImage.length - 1; i >= 0; i--) {
                    prevSelectedImage[i].classList.remove("ct-selected-cloudinary-image");
                  }
                  ContentEdit.addCSSClass(this, 'ct-selected-cloudinary-image');
                  return true;
                };
              })(this));
              image_div.innerHTML = images.resources[i].image_tag;
              cloudinaryMediaLibrary.appendChild(image_div);
            }
          }
          else
          {
            domNotFoundDiv = document.createElement('div');
            domNotFoundDiv.textContent = "No images found";
            ContentEdit.addCSSClass(domNotFoundDiv, 'ct-image-not-found');
            cloudinaryMediaLibrary.appendChild(domNotFoundDiv);
          }
        }
      };
      xhttp.open("GET", CloudinaryUploader.phpUrl+"?action=allimages&search="+searchText, true);
      xhttp.send();
    };

    CloudinaryUploader.prototype._onMediaLibrary = function() {
      this._dialog.clear();
      var clearBusy;
      this._dialog.busy(true);
      this._dialog._domView.innerHTML = "";
      this._dialog._domCaption.textContent = "Select image"
      ContentEdit.removeCSSClass(this._dialog._domView, 'ct-image-dialog__view');
      ContentEdit.addCSSClass(this._dialog._domView, 'ct-cloudinary-medialibrary__view');
      ContentEdit.removeCSSClass(this._dialog._domElement, 'ct-image-dialog');
      ContentEdit.removeCSSClass(this._dialog._domElement, 'ct-image-dialog--populated');
      ContentEdit.addCSSClass(this._dialog._domElement, 'ct-cloudinary-medialibrary-dialog');
      ContentEdit.addCSSClass(this._dialog._domElement, 'ct-image-dialog--empty');
      var cloudinaryMediaSearch = this._dialog.constructor.createDiv(['ct-cloudinary-medialibrary-search']);
      this._domSearchInput = document.createElement('input');
      this._domSearchInput.setAttribute('class', 'ct-cloudinary-medialibrary__text-search');
      this._domSearchInput.setAttribute('name', 'search');
      this._domSearchInput.setAttribute('type', 'text');
      this._domSearchInput.setAttribute('placeholder', 'Search image');
      cloudinaryMediaSearch.appendChild(this._domSearchInput);
      this._dialog._domView.appendChild(cloudinaryMediaSearch);
      this._domSearchBtn = this._dialog.constructor.createDiv(['ct-control', 'ct-control--text', 'ct-control--cloudinarysearch']);
      this._domSearchBtn.textContent = ContentEdit._('Find');
      this._domSearchBtn.addEventListener('click', (function(_this) {
        return function() {
          var searchText = document.querySelector(".ct-cloudinary-medialibrary__text-search");
          return _this._onSearch(searchText.value);
        };
      })(this));
      cloudinaryMediaSearch.appendChild(this._domSearchBtn);
      this.cloudinaryMediaLibrary = this._dialog.constructor.createDiv(['ct-cloudinary-medialibrary-group']);
      this._dialog._domView.appendChild(this.cloudinaryMediaLibrary);
      this.cloudinaryLoadMore = this._dialog.constructor.createDiv(['ct-cloudinary-loadmore', 'ct-hide-loadmore']);
      this._domLoadMoreBtn = this._dialog.constructor.createDiv(['ct-control', 'ct-control--text', 'ct-control--cloudinaryloadmore']);
      this.cloudinaryLoadMore.appendChild(this._domLoadMoreBtn);
      this._domLoadMoreBtn.textContent = ContentEdit._('Load more');
      this._domLoadMoreBtn.addEventListener('click', (function(_this) {
        return function() {
          var searchText = document.querySelector(".ct-cloudinary-medialibrary__text-search");
          return _this._onLoadMore(searchText.value);
        };
      })(this));
      this._dialog._domView.appendChild(this.cloudinaryLoadMore);
      var images;
      var xhttp = new XMLHttpRequest();
      var __dialog = this._dialog;
      var cloudinaryMediaLibrary = this.cloudinaryMediaLibrary;
      var cloudinaryLoadMore = this.cloudinaryLoadMore;
      xhttp.onreadystatechange = function(res) {
        if (this.readyState == 4 && this.status == 200) {
          __dialog.busy(false)
          images = JSON.parse(res.target.response);
          if(images.next_cursor)
          {
            ContentEdit.removeCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
            cloudinaryLoadMore.setAttribute('data-nextcursor', images.next_cursor);
          }
          else
          {
            ContentEdit.addCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
          }
          for (var i = images.resources.length - 1; i >= 0; i--) {
            var image_div = __dialog.constructor.createDiv(['ct-cloudinary-image-item']);
            image_div.setAttribute('data-resources', JSON.stringify(images.resources[i]));
            image_div.addEventListener('click', (function(_this) {
              return function() {
                var prevSelectedImage = document.querySelectorAll(".ct-selected-cloudinary-image");
                for (var i = prevSelectedImage.length - 1; i >= 0; i--) {
                  prevSelectedImage[i].classList.remove("ct-selected-cloudinary-image");
                }
                ContentEdit.addCSSClass(this, 'ct-selected-cloudinary-image');
                return true;
              };
            })(this));
            image_div.innerHTML = images.resources[i].image_tag;
            cloudinaryMediaLibrary.appendChild(image_div);
          }
        }
      };
      xhttp.open("GET", CloudinaryUploader.phpUrl+"?action=allimages", true);
      xhttp.send();
    };

    CloudinaryUploader.prototype._onLoadMore = function(searchText) {
      var clearBusy;
      this._dialog.busy(true);
      var images;
      var xhttp = new XMLHttpRequest();
      var __dialog = this._dialog;
      var cloudinaryMediaLibrary = this.cloudinaryMediaLibrary;
      var cloudinaryLoadMore = this.cloudinaryLoadMore;
      var next_cursor = cloudinaryLoadMore.getAttribute('data-nextcursor');
      xhttp.onreadystatechange = function(res) {
        if (this.readyState == 4 && this.status == 200) {
          __dialog.busy(false)
          images = JSON.parse(res.target.response);
          if(images.next_cursor)
          {
            ContentEdit.removeCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
            cloudinaryLoadMore.setAttribute('data-nextcursor', images.next_cursor);
          }
          else
          {
            ContentEdit.addCSSClass(cloudinaryLoadMore, 'ct-hide-loadmore');
          }
          if(typeof images.resources !== 'undefined' && images.resources.length > 0)
          {
            for (var i = images.resources.length - 1; i >= 0; i--) {
              var image_div = __dialog.constructor.createDiv(['ct-cloudinary-image-item']);
              image_div.setAttribute('data-resources', JSON.stringify(images.resources[i]));
              image_div.addEventListener('click', (function(_this) {
                return function() {
                  var prevSelectedImage = document.querySelectorAll(".ct-selected-cloudinary-image");
                  for (var i = prevSelectedImage.length - 1; i >= 0; i--) {
                    prevSelectedImage[i].classList.remove("ct-selected-cloudinary-image");
                  }
                  ContentEdit.addCSSClass(this, 'ct-selected-cloudinary-image');
                  return true;
                };
              })(this));
              image_div.innerHTML = images.resources[i].image_tag;
              cloudinaryMediaLibrary.appendChild(image_div);
            }
          }
          else
          {
            domNotFoundDiv = document.createElement('div');
            domNotFoundDiv.textContent = "No images found";
            ContentEdit.addCSSClass(domNotFoundDiv, 'ct-image-not-found');
            cloudinaryMediaLibrary.appendChild(domNotFoundDiv);
          }
        }
      };
      if(searchText)
      {
        xhttp.open("GET", CloudinaryUploader.phpUrl+"?action=allimages&next_cursor="+next_cursor+"&search="+searchText, true);
      }
      else
      {
        xhttp.open("GET", CloudinaryUploader.phpUrl+"?action=allimages&next_cursor="+next_cursor, true);
      }
      xhttp.send();
      return;
    };

    CloudinaryUploader.prototype._onClear = function() {
      return this._dialog.clear();
    };

    CloudinaryUploader.prototype._getUploadedFile = function(file) {
      var upload;
      var clearBusy;
      this._dialog.busy(true);
      var data = new FormData();
      data.append('SelectedFile', file);
      var xhttp = new XMLHttpRequest();
      var __dialog = this._dialog;
      var cloudinaryMediaLibrary = this.cloudinaryMediaLibrary;
      var __this = this;
      xhttp.onreadystatechange = function(res) {
        if (this.readyState == 4 && this.status == 200) {
          __dialog.busy(false);
          var image = JSON.parse(res.target.response);
          if(image.status == 'success')
          {
            return __this._onFileReady(image.data);
          }
        }
      }
      xhttp.open("POST", CloudinaryUploader.phpUrl+"?action=uploadimage", true);
      xhttp.send(data);
      return;
    };

    CloudinaryUploader.prototype._goToUpload = function(file) {
      this._dialog._domCaption.textContent = "Upload image"
      ContentEdit.removeCSSClass(this._dialog._domView, 'ct-cloudinary-medialibrary__view');
      ContentEdit.addCSSClass(this._dialog._domView, 'ct-image-dialog__view');
      ContentEdit.removeCSSClass(this._dialog._domElement, 'ct-cloudinary-medialibrary-dialog');
      ContentEdit.addCSSClass(this._dialog._domElement, 'ct-image-dialog');
      this._dialog._domView.innerHTML = "";
      return this._onClear();
    };

    CloudinaryUploader.prototype._onFileReady = function(file) {
      this._dialog._domCaption.textContent = "Upload image"
      ContentEdit.removeCSSClass(this._dialog._domView, 'ct-cloudinary-medialibrary__view');
      ContentEdit.addCSSClass(this._dialog._domView, 'ct-image-dialog__view');
      ContentEdit.removeCSSClass(this._dialog._domElement, 'ct-cloudinary-medialibrary-dialog');
      ContentEdit.addCSSClass(this._dialog._domElement, 'ct-image-dialog');
      this._dialog._domView.innerHTML = "";
      CloudinaryUploader.selectedImage = file;
      return this._dialog.populate(file.url, [file.width, file.height]);
    };

    CloudinaryUploader.prototype._onMount = function() {};

    CloudinaryUploader.prototype._onSave = function() {
      var clearBusy;
      this._dialog.busy(true);
      clearBusy = (function(_this) {
        return function() {
          _this._dialog.busy(false);
          return _this._dialog.save(CloudinaryUploader.selectedImage.url, [CloudinaryUploader.selectedImage.width, CloudinaryUploader.selectedImage.height], {
            alt: CloudinaryUploader.selectedImage.public_id,
            data_cloudinary: 1,
          });
        };
      })(this);
      return setTimeout(clearBusy, 1500);
    };

    CloudinaryUploader.prototype._onUnmount = function() {};

    CloudinaryUploader.createCloudinaryUploader = function(dialog) {
      return new CloudinaryUploader(dialog);
    };

    return CloudinaryUploader;

  })();


  window.CloudinaryUploader = CloudinaryUploader;
  window.onload = function() {
    var FIXTURE_TOOLS, IMAGE_FIXTURE_TOOLS, LINK_FIXTURE_TOOLS, editor, req;
    ContentTools.IMAGE_UPLOADER = CloudinaryUploader.createCloudinaryUploader;
    ContentTools.StylePalette.add([new ContentTools.Style('By-line', 'article__by-line', ['p']), new ContentTools.Style('Caption', 'article__caption', ['p']), new ContentTools.Style('Example', 'example', ['pre']), new ContentTools.Style('Example + Good', 'example--good', ['pre']), new ContentTools.Style('Example + Bad', 'example--bad', ['pre'])]);
    editor = ContentTools.EditorApp.get();
    editor.init('[data-editable], [data-fixture]', 'data-name');
    editor.addEventListener('saved', function(ev) {
      var saved;
      if (Object.keys(ev.detail().regions).length === 0) {
        return;
      }
      editor.busy(true);
      saved = (function(_this) {
        return function() {
          editor.busy(false);
          return new ContentTools.FlashUI('ok');
        };
      })(this);
      return setTimeout(saved, 2000);
    });
    FIXTURE_TOOLS = [['undo', 'redo', 'remove']];
    IMAGE_FIXTURE_TOOLS = [['undo', 'redo', 'image']];
    LINK_FIXTURE_TOOLS = [['undo', 'redo', 'link']];
    ContentEdit.Root.get().bind('focus', function(element) {
      var tools;
      if (element.isFixed()) {
        if (element.type() === 'ImageFixture') {
          tools = IMAGE_FIXTURE_TOOLS;
        } else if (element.tagName() === 'a') {
          tools = LINK_FIXTURE_TOOLS;
        } else {
          tools = FIXTURE_TOOLS;
        }
      } else {
        tools = ContentTools.DEFAULT_TOOLS;
      }
      if (editor.toolbox().tools() !== tools) {
        return editor.toolbox().tools(tools);
      }
    });
    req = new XMLHttpRequest();
    req.overrideMimeType('application/json');
    req.open('GET', 'https://raw.githubusercontent.com/GetmeUK/ContentTools/master/translations/lp.json', true);
    return req.onreadystatechange = function(ev) {
      var translations;
      if (ev.target.readyState === 4) {
        translations = JSON.parse(ev.target.responseText);
        ContentEdit.addTranslations('lp', translations);
        return ContentEdit.LANGUAGE = 'lp';
      }
    };
  };

}).call(this);
