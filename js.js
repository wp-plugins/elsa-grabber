$(document).ready(function() {

    //��� �������� ��������...
    $(".tab_content").hide(); //������ ��� ����������
    $("ul.tabs li:first").addClass("active").show(); //������������ ������ �������
    $(".tab_content:first").show(); //�������� ������� ������ �������

    //������� ������� ������ ����
    $("ul.tabs li").click(function() {

        $("ul.tabs li").removeClass("active"); //������� "active" ����� ������ �������
        $(this).addClass("active"); //�������� "active" ����� ��������� �������
        $(".tab_content").hide(); //������ ���� ������� ������ �������
        var activeTab = $(this).find("a").attr("href"); //�������� ����� ������� ���� ������
        $(activeTab).fadeIn(); //��������� ��� ���������� �������� ������� �������
return false;
    });
});
function getParamTask(a,a1)
  {
    var ret='';
    var alldata = 'filename='+a+'&need='+a1;
    alldata+='&getparam=true'
       ret=$.ajax({
       url: "../wp-content/plugins/elsa/_globaltask.php",
       cache: false,
       error:function (b,b1,b2){alert(b2);},
       async: false,
       data: alldata,
       success: function(html){
         return html;

         }
          }).responseText;
  return ret;
  }
