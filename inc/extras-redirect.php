<?php
function quest_redirect_collection($uri, $uris = null)
{
    $_url = quest_get_redirect_url($uri, $uris);

    if (!empty($_url)) {
        wp_redirect($_url, 302);
        exit();
    }

}

function quest_get_redirect_url($uri, $uris = null)
{
    $URL = home_url();
    $_url = "";
    $uri=rtrim($uri,'/');
    if ($uri == '/wp-admin') {
	    $_url = $URL .'/wp-admin/index.php';
    } elseif ($uri == '/financial-it-services.aspx') {
	    $_url = get_permalink(258);
    } elseif ($uri == '/commercial-it-services.aspx') {
	    $_url = get_permalink(502);
    } elseif ($uri == '/application-development.aspx') {
        $_url = get_permalink(5847);
    } elseif ($uri == '/application-development/sql-support.aspx') {
        $_url = get_permalink(5847);
    } elseif ($uri == '/cloud-computing-solutions') {
        $_url = get_permalink(5883);
    } elseif ($uri == '/cloud-computing-solutions/cloud-computing-virtualization.aspx') {
        $_url = get_permalink(5883);
    } elseif ($uri == '/cloud-computing-solutions/hybrid-cloud-computing.aspx') {
        $_url = get_permalink(5883);
    } elseif ($uri == '/CloudOps.aspx') {
        $_url = get_permalink(5883);
    } elseif ($uri == '/contract-management-infographic.aspx') {
        $_url = get_permalink(5065);
    } elseif ($uri == '/contract-management-services.aspx') {
        $_url = get_permalink(5065);
    } elseif ($uri == '/data-center-expansion.aspx') {
        $_url = get_permalink(4948);
    } elseif ($uri == '/data-center-services.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/assessments.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/DRfortheDay') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/nocMap.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/technologyCenterVideo.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services.aspx/cloudAssessment') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-center-services/network-operations-center.aspx') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/data-circuits-provider.aspx/assessments.aspx') {
        $_url = get_permalink(5967);
    } elseif ($uri == '/data-circuits-provider.aspx/cabling_video.aspx') {
        $_url = get_permalink(5967);
    } elseif ($uri == '/data-circuits-provider.aspx/DRfortheDay') {
        $_url = get_permalink(5967);
    } elseif ($uri == '/data-circuits-provider.aspx/StopMalware.aspx') {
        $_url = get_permalink(5967);
    } elseif ($uri == '/data-circuits-provider.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(5967);
    } elseif ($uri == '/data-loss-prevention/creating-a-dlp-strategy.aspx') {
        $_url = get_permalink(5984);
    } elseif ($uri == '/data-loss-prevention/identify-data.aspx') {
        $_url = get_permalink(5984);
    } elseif ($uri == '/data-security.aspx/brcVideo.aspx') {
        $_url = get_permalink(5843);
    } elseif ($uri == '/data-theft-and-security.aspx') {
        $_url = get_permalink(3873);
    } elseif ($uri == '/Default.aspx') {
        $_url = $URL . '/';
    } elseif ($uri == '/default.aspx') {
        $_url = $URL . '/';
    } elseif ($uri == '/Extranet/95975/forms.aspx' && @$uris['path']='msgid=292a252d-cd48-44d1-857a-e4fd5f315752') {
        $_url = get_permalink(796);
    } elseif ($uri == '/disaster-recovery-services.aspx/assessments.aspx') {
        $_url = get_permalink(364);
    } elseif ($uri == '/disaster-recovery-services/thanks-disaster-recovery-signup.aspx'
    || $uri == '/thanks-appdev-worksheet.aspx'
    || $uri == '/thanks.aspx'
    ) {
        $_url = get_permalink(1032);
    } elseif ($uri == '/government-it-solutions/aerospace-defense.aspx') {
        $_url = get_permalink(3549);
    } elseif ($uri == '/government-it-solutions/government-cloud.aspx') {
        $_url = get_permalink(3549);
    } elseif ($uri == '/government-it-solutions/mobile-device-management.aspx') {
        $_url = get_permalink(3549);
    } elseif ($uri == '/government-it-solutions/unified-communications.aspx') {
        $_url = get_permalink(3549);
    } elseif ($uri == '/pr_2015-cisco-Architecture-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015-cisco-Security-Architecture.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015-cisco-Video-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015-CRN-award.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015-Quest-Named-CRN-2015-Fast-Growth-150-List.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015Cisco.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015CiscoInfrastructure.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015CiscoPartnerSummit.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015CRN250.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015CRNsp500.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015MSgoldHosting.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015mspelite150.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2015msprovider.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-cisco-Advanced-Data-Center-Architecture-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-CRN-MSP-500-Tech-Elite.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-CRN-Tech-Elite-Solution-Providers.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Advanced-Collaboration-Architecture-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Advanced-Video-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Cisco Gold-Certification-2.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Cisco-Gold-Certification.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Platinum-Status-Veeam-Cloud-Service-Provider.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Achieves-Security-Architecture-Specialization.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Certified-Cisco-Powered-Cloud-and-Managed-Services.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Master-Designation-Cloud-and-Managed-Services.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Named-CRN-2016-Fast-Growth-150.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Named-CRN-2016-Solution-Provider.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2016-Quest-Named-CRN-Triple-Crown-Award-Winner.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_2017-11-Quest-Achieves-Advanced-Collaboration-Architecture-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(6272);
    } elseif ($uri == '/pr_2017-11-Quest-Technology-Management-Achieves-Advanced-Video-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(7169);
    } elseif ($uri == '/pr_2017-Quest-Achieves-Cisco-Gold-Certification.aspx') {
        $_url = get_permalink(6969);
    } elseif ($uri == '/pr_2017-Quest-Achieves-Recognized-Excellence-Managed-IT-Services.aspx') {
        $_url = get_permalink(7155);
    } elseif ($uri == '/pr_2017-Quest-Achieves-the-Advanced-Unified-Computing-Technology-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(7153);
    } elseif ($uri == '/pr_2017-Quest-Named-One-Tech-Elite-Solution-Providers-CRN.aspx') {
        $_url = get_permalink(7159);
    } elseif ($uri == '/pr_2017-Quest-Renews-Master-Designation-to-Provide-Cisco-Powered-Cloud-and-Managed-Services.aspx') {
        $_url = get_permalink(6891);
    } elseif ($uri == '/pr_2017-Quest-Technology-Management-Achieves-Advanced-Security-Architecture-Specialization.aspx') {
        $_url = get_permalink(7166);
    } elseif ($uri == '/pr_2017-Quest-Technology-Management-Achieves-Data-Center-Architecture-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(7163);
    } elseif ($uri == '/pr_2017-Quest-Technology-Management-Named-to-CRN-2017-Solution-Provider-500 List.aspx') {
        $_url = get_permalink(7161);
    } elseif ($uri == '/pr_2018-01-Quest-Achieves-Cisco-Advanced-Enterprise-Networks-Architecture-Specialization.aspx') {
        $_url = get_permalink(6907);
    } elseif ($uri == '/pr_2018-02-Quest-Recognized-for-Excellence-in-Managed-IT-Services.aspx') {
        $_url = get_permalink(333);
    } elseif ($uri == '/pr_2018-03-Quest-Named-One-of-2018-Tech-Elite-Solution-Providers-by-CRN.aspx') {
        $_url = get_permalink(332);
    } elseif ($uri == '/pr_2018-06-Quest-Named-CRN-2018-Solution-Provider-500-List.aspx') {
        $_url = get_permalink(331);
    } elseif ($uri == '/pr_2018-09-Quest-Achieves-Advanced-Security-Architecture-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(330);
    } elseif ($uri == '/pr_2018-12-Quest-Achieves-Advanced-Collaboration-Architecture-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(6907);
    } elseif ($uri == '/pr_2019-01-22-Quest-Achieves-Advanced-Enterprise-Networks-Architecture-Specialization-from-Cisco.aspx') {
        $_url = get_permalink(6637);
    } elseif ($uri == '/pr_2019-01-30-Quest-Achieves-Cisco-Gold-Certification.aspx') {
        $_url = get_permalink(7178);
    } elseif ($uri == '/pr_2019-01-30-Quest-Renews-Master-Designation-Provide-Cisco-Powered-Cloud-Managed-Services.aspx') {
        $_url = get_permalink(6707);
    } elseif ($uri == '/pr_2019-02-19-Quest-Recognized-for-Excellence-in-Managed-IT-Services.aspx') {
        $_url = get_permalink(7175);
    } elseif ($uri == '/pr_3crown.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_ciscoMasterServiceProvider.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_CRN13TechElite.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_Quest-Achieves-Cisco-Advanced-Content-Security-Specialization-2014.aspx') {
        $_url = get_permalink(6953);
    } elseif ($uri == '/video-conferencing') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video/business-resumption__trashed') {
        $_url = get_permalink(3885);
    } elseif ($uri == '/video/business-resumption') {
        $_url = get_permalink(3885);
    } elseif ($uri == '/calstar-customer-story.aspx') {
        $_url = get_permalink(3877);
    } elseif ($uri == '/cloud-assessment') {
        $_url = $URL . '/wp-content/uploads/2018/11/Cloud-Workshop.pdf';
    } elseif ($uri == '/cloud-computing-solutions/cloud-based-disaster-recovery.aspx') {
        $_url = get_permalink(990);
    } elseif ($uri == '/data-replication-video.aspx') {
        $_url = get_permalink(5877);
    } elseif ($uri == '/database-health.aspx') {
        $_url = get_permalink(3882);
    } elseif ($uri == '/desktops-as-a-service/advantages-of-daas.aspx') {
        $_url = get_permalink(5990);
    } elseif ($uri == '/desktops-as-a-service/what-is-daas.aspx') {
        $_url = get_permalink(5990);
    } elseif ($uri == '/directionalboring.aspx') {
        $_url = get_permalink(995);
    } elseif ($uri == '/disaster-recovery-and-business-continuity-video.aspx') {
        $_url = get_permalink(3885);
    } elseif ($uri == '/disaster-recovery-services.aspx/drDayVideo.aspx') {
        $_url = get_permalink(3878);
    } elseif ($uri == '/disaster-recovery-services/disaster-recovery-workshop-video.aspx') {
        $_url = get_permalink(3878);
    } elseif ($uri == '/ePlaybook') {
        $_url = $URL . '/';
    } elseif ($uri == '/ePlaybook/index.html') {
        $_url = $URL . '/';
    } elseif ($uri == '/fiber-optic-internet.aspx') {
        $_url = get_permalink(311);
    } elseif ($uri == '/fiber-optic') {
        $_url = get_permalink(311);
    } elseif ($uri == '/file-sharing.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/fileSharing.aspx') {
        $_url = quest_resource_url(['resources[]' => 'assessment']);
    } elseif ($uri == '/firewall-assessment-video.aspx') {
        $_url = quest_resource_url(['resources[]' => 'video']);
    } elseif ($uri == '/firewall-review.aspx') {
        $_url = quest_resource_url(['resources[]' => 'assessment']);
    } elseif ($uri == '/fremontbank_study.aspx') {
        $_url = get_permalink(7338);
    } elseif ($uri == '/goldstar') {
        $_url = $URL . '/';
    } elseif ($uri == '/helpDesk.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/Horizon-Daas.aspx') {
        $_url = $URL . '/wp-content/uploads/2019/01/DaaS.pdf';
    } elseif ($uri == '/infrastructure-video.aspx') {
        $_url = get_permalink(995);
    } elseif ($uri == '/leads/Default.aspx') {
        $_url = $URL . '/';
    } elseif ($uri == '/leads/leadForm.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/leads/leadForm.aspx/Account/login.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/leads/leadForm.aspx/account/login.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/leads/leadForm.aspx/default.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/leads/leadForm.aspx/qmsPtrPortal/Account/login.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/Leads/thanksLeads.aspx') {
        $_url = get_permalink(3766);
    } elseif ($uri == '/Login.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/login.aspx' && $uris['query'] == 'ReturnUrl=/Download/Download.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/managed-services/data-backup-services.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/managed-services/managed-applications.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/managed-services/managed-messaging-services.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/managed-services/managed-security-services.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/managed-services/system-monitoring.aspx') {
        $_url = get_permalink(988);
    } elseif ($uri == '/media_methods.aspx') {
        $_url = get_permalink(31);
    } elseif ($uri == '/media.aspx') {
        $_url = get_permalink(31);
    } elseif ($uri == '/partner-opportunity-registration') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/playbook/partners.html') {
        $_url = get_permalink(383);
    } elseif ($uri == '/pr_beachhead.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_BusinessResumptionCenter.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_c7Coloaspx.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_cable_cmas.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_ciscoATP2011.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_ciscoCloud.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_CiscoCustSat.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_CRNFastGrowth2013.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_DaaSDesktone.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_e_security.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_gorillaAward.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_gsChannelPartnersBoard.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_MakeAWish2010.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_no_nevada.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_passlogix.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_procera.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_procera2.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_ptrReadyDaaS.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_questCatalog.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_questCitrixCollaboration.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_questEgnyte.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_QuestIntellitactics.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_replication_Services.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_sacbizjournal.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_smart100.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_staffing.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_ticket2future01.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_Top100CloudProvider.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_university_reno.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_var2002.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_var500_07.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_vsp.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pr_WalkNRock2010.aspx') {
        $_url = $URL . '/press-release/';
    } elseif ($uri == '/pressreleases.aspx') {
        $_url = quest_resource_url(['resources[]' => 'press-release']);
    } elseif ($uri == '/pressReleases.aspx') {
        $_url = quest_resource_url(['resources[]' => 'press-release']);
    } elseif ($uri == '/professional-services/email-archiving.aspx') {
        $_url = get_permalink(467);
    } elseif ($uri == '/quest_veeam_p2w') {
        $_url = get_permalink(3625);
    } elseif ($uri == '/quest-smart-net-services.aspx') {
        $_url = get_permalink(3870);
    } elseif ($uri == '/registration-form-draas-for-dummies-free-ebook') {
        $_url = get_permalink(3592);
    } elseif ($uri == '/registration-form-quest-veeam-ransomware') {
        $_url = get_permalink(3604);
    } elseif ($uri == '/registration-form-the-case-for-office-365-backup') {
        $_url = get_permalink(902);
    } elseif ($uri == '/SANpreference.aspx') {
        $_url = get_permalink(7085);
    } elseif ($uri == '/security-workshop-video.aspx') {
        $_url = get_permalink(3875);
    } elseif ($uri == '/server-end-of-life.aspx') {
        $_url = get_permalink(467);
    } elseif ($uri == '/SnapMirror') {
        $_url = $URL . '/vendor/';
    } elseif ($uri == '/solution-brief/cloud-computing-solutions') {
        $_url = get_permalink(5883);
    } elseif ($uri == '/solution-brief/co-location-facilities') {
        $_url = $URL . '/wp-content/uploads/2018/11/Co-location-Services.pdf';
    } elseif ($uri == '/solution-brief/daas/PastedGraphic-1') {
        $_url = $URL . '/';
    } elseif ($uri == '/solution-brief/fiber-optic') {
        $_url = get_permalink(311);
    } elseif ($uri == '/solution-brief/infrastrure-as-a-service-iaas') {
        $_url = $URL . '/wp-content/uploads/2019/01/Infrastrure-as-a-Service-IaaS.pdf';
    } elseif ($uri == '/solution-brief/network-management') {
        $_url = get_permalink(5961);
    } elseif ($uri == '/solution-brief/network-performance-and-monitoring-and-maintenance') {
        $_url = get_permalink(5946);
    } elseif ($uri == '/solution-brief/voip') {
        $_url = $URL . '/';
    } elseif ($uri == '/solution-brief/wireless-design-and-implementation') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/strategic-advisor.aspx') {
        $_url = quest_resource_url(['resources[]' => 'newsletter']);
    } elseif ($uri == '/subscription-preferences') {
        $_url = get_permalink(7085);
    } elseif ($uri == '/techbriefingandmoviepremier_reg_thank_you.aspx') {
        $_url = $URL . '/';
    } elseif ($uri == '/techbriefingandmoviepremier_reg.aspx') {
        $_url = $URL . '/';
    } elseif ($uri == '/technology-center-video.aspx') {
        $_url = get_permalink(3887);
    } elseif ($uri == '/TechnologyPartners/programOverview.aspx') {
        $_url = get_permalink(383);
    } elseif ($uri == '/telecom-audit-infographic.aspx') {
        $_url = $URL . '/wp-content/uploads/2018/11/Telecom.pdf';
    } elseif ($uri == '/telecom-audit.aspx') {
        $_url = get_permalink(3867);
    } elseif ($uri == '/thoughtLeader.aspx') {
        $_url = quest_resource_url(['resources[]' => 'ceo-blog']);
    } elseif ($uri == '/user/QuesTechUSA') {
        $_url = $URL . '/';
    } elseif ($uri == '/user/QuesTechUSA/videos') {
        $_url = $URL . '/';
    } elseif ($uri == '/who-we-are.aspx') {
        $_url = get_permalink(92);
    } elseif ($uri == '/customer-story/redwood-credit-union-disaster-recover-wildfires') {
        $_url = get_permalink(7356);
    } elseif ($uri == '/disaster-recovery-services.aspx/DRfortheDay') {
        $_url = $URL . '/wp-content/uploads/2018/11/BusinessContinuityWorkshop.pdf';
    } elseif ($uri == '/disaster-recovery-services.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(3878);
    } elseif ($uri == '/disaster-recovery-services/data-center-services-map.aspx') {
        $_url = get_permalink(990);
    } elseif ($uri == '/disaster-recovery-services/incident-response-team.aspx') {
        $_url = get_permalink(990);
    } elseif ($uri == '/disaster-recovery-services/disaster-recovery-infographic.aspx') {
        $_url = get_permalink(990);
    } elseif ($uri == '/disaster-recovery-services/disaster-recovery-plan.aspx') {
        $_url = get_permalink(990);
    } elseif ($uri == '/events.aspx') {
        $_url = get_permalink(92);
    } elseif ($uri == '/healthcare-interpreter.aspx') {
        $_url = get_permalink(496);
    } elseif ($uri == '/high-availability-business-center-video.aspx') {
        $_url = $URL . '/wp-content/uploads/2019/01/DaaS.pdf';
    } elseif ($uri == '/it-staffing-company.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/it-staffing-company/it-staffing-company-faq.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/it-staffing-company/staff-screening-and-augmentation.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/it-staffing-company/technical-competencies.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/it-talent-showcase.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/it-training-courses.aspx') {
        $_url = get_permalink(5789);
    } elseif ($uri == '/naspo-fulfillment-partners.aspx') {
        $_url = get_permalink(4552);
    } elseif ($uri == '/network-assessment') {
        $_url = get_permalink(5416);
    } elseif ($uri == '/security-workshop') {
        $_url = get_permalink(5410);
    } elseif ($uri == '/staffing-and-recruiting') {
        $_url = quest_resource_url(['resources[]' => 'newsletter']);
    } elseif ($uri == '/naspo-valuepoint-supplier-partner') {
        $_url = get_permalink(1147);
    } elseif ($uri == '/physical-security-assessment.aspx') {
        $_url = get_permalink(5079);
    } elseif ($uri == '/quest-baas-draas-using-veeam-cloud-connect-video') {
        $_url = get_permalink(3635);
    } elseif ($uri == '/quest-veeam-solutions') {
        $_url = get_permalink(6626);
    } elseif ($uri == '/risk-management') {
        $_url = get_permalink(356);
    } elseif ($uri == '/risk-management/risk-management-quiz.aspx') {
        $_url = get_permalink(356);
    } elseif ($uri == '/risk-management/risk-management-services.aspx') {
        $_url = get_permalink(356);
    } elseif ($uri == '/security-awareness-compliance') {
        $_url = get_permalink(5872);
    } elseif ($uri == '/security-incident-response') {
        $_url = get_permalink(6884);
    } elseif ($uri == '/security-policy.aspx') {
        $_url = get_permalink(5100);
    } elseif ($uri == '/services.aspx') {
        $_url = get_permalink(18);
    } elseif ($uri == '/shape-your-own-cloud.aspx') {
        $_url = get_permalink(3883);
    } elseif ($uri == '/solution-brief/cybersecurity') {
        $_url = get_permalink(560);
    } elseif ($uri == '/solution-brief/it-professional-services') {
        $_url = get_permalink(5946);
    } elseif ($uri == '/solution-brief/staffing-and-recruiting') {
        $_url = get_permalink(5108);
    } elseif ($uri == '/vendorlist.aspx') {
        $_url = $URL . '/vendor/';
    } elseif ($uri == '/vendorList.aspx') {
        $_url = $URL . '/vendor/';
    } elseif ($uri == '/vendors.aspx') {
        $_url = $URL . '/vendor/';
    } elseif ($uri == '/video-conferencing-solutions.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions.aspx/assessments.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions.aspx/DRfortheDay') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions/how-video-conferencing-can-help-businesses.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions/key-capabilities.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/video-conferencing-solutions/video-conferencing-overview.aspx') {
        $_url = get_permalink(6014);
    } elseif ($uri == '/voip-network.aspx/assessments.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-network.aspx/brcVideo.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-network.aspx/DRfortheDay') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-network.aspx/StopMalware.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-network.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-readiness-check.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-technology-infographic.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/voip-technology.aspx') {
        $_url = get_permalink(5974);
    } elseif ($uri == '/wireless-design-and-implementation.aspx/assessments.aspx') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/wireless-design-and-implementation.aspx/dataSecurity.aspx') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/wireless-design-and-implementation.aspx/DRfortheDay') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/wireless-design-and-implementation.aspx/StopMalware.aspx') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/wireless-design-and-implementation.aspx/virtualDesktops.aspx') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/wireless-review.aspx') {
        $_url = get_permalink(5817);
    } elseif ($uri == '/assessment/co-location-services') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/co-location_services-infographic.aspx') {
        $_url = get_permalink(6005);
    }
    return $_url;
}

function quest_resource_redirect_empty_content_pre()
{
    $URL = home_url();
    $uris = parse_url($_SERVER['REQUEST_URI']);
    $uri = $uris['path'];
    $_url = "";
    $uri=rtrim($uri,'/');
    $uri_lo = strtolower($uri);
    if ($uri_lo == '/ceoblog' || $uri_lo == '/ceoblog') {
        $_url = quest_resource_url(['resources[]' => 'ceo-blog']);
    } elseif ($uri_lo == '/partnerblog' || $uri_lo == '/partnerblog') {
        $_url = quest_resource_url(['resources[]' => 'partner-blog']);
    } elseif ($uri == '/data-center-services.aspx/cloudAssessment') {
        $_url = get_permalink(6005);
    } elseif ($uri == '/application-security') {
	    $_url = get_permalink(5847);
    } elseif ($uri == '/data-circuits-provider.aspx/cloudAssessment') {
        $_url = $URL . '/data-and-voice-circuits/';
    } elseif ($uri == '/disaster-recovery-services.aspx/cloudAssessment') {
        $_url = $URL . '/services/disaster-recovery/';
    } elseif ($uri == '/disaster-recovery-workshop') {
        $_url = get_permalink(364);
    } elseif ($uri == '/draas') {
        $_url = get_permalink(5979);
    } elseif ($uri == '/quest-baas-draas-using-veeam-cloud-connect') {
        $_url = get_permalink(860);
    } elseif ($uri == '/risk-management') {
        $_url = get_permalink(356);
    } elseif ($uri == '/security-workshop') {
        $_url = get_permalink(5100);
    } elseif ($uri == '/solution-brief/incident-response') {
        $_url = $URL . '/wp-content/uploads/2019/01/Infrastrure-as-a-Service-IaaS.pdf';
    } elseif ($uri == '/staffing-and-recruiting') {
        $_url = quest_resource_url(['resources[]' => 'newsletter']);
    } elseif ($uri == '/voip-network.aspx/cloudAssessment') {
        $_url = $URL . '/voip/';
    } elseif ($uri == '/wireless-design-and-implementation.aspx/cloudAssessment') {
        $_url = $URL . '/wireless-design-and-implementation/';
    } elseif ($uri == '/solution-brief/draas-and-baas/draas-and-baas-quest') {
        $_url = $URL . '/wp-content/uploads/2018/11/DRaaS-and-BaaS-Quest.pdf';
    }
    if (!empty($_url)) {
        wp_redirect($_url, 302);
        exit();
    }
}