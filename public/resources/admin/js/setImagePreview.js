
function setImagePreview(input_id,img_id) { 
        var docObj=document.getElementById(input_id); 
        var imgObjPreview=document.getElementById(img_id); 
        if(docObj.files && docObj.files[0]){ 
        //����£�ֱ����img���� 
        imgObjPreview.style.display = 'block'; 
        imgObjPreview.style.width = '100%'; 
        //imgObjPreview.src = docObj.files[0].getAsDataURL(); 
        //���7���ϰ汾�����������getAsDataURL()��ʽ��ȡ����Ҫһ�·�ʽ 
        imgObjPreview.src = window.URL.createObjectURL(docObj.files[0]); 
        }else{ 
        //IE�£�ʹ���˾� 
        docObj.select(); 
        var imgSrc = document.selection.createRange().text; 
       
        //ͼƬ�쳣�Ĳ�׽����ֹ�û��޸ĺ�׺��α��ͼƬ 
        try{ 
        localImagId.style.filter="progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale)"; 
        localImagId.filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = imgSrc; 
        }catch(e){ 
        alert("���ϴ���ͼƬ��ʽ����ȷ��������ѡ��!"); 
        return false; 
        } 
        imgObjPreview.style.display = 'none'; 
        document.selection.empty(); 
        } 
        return true; 
    } 
     